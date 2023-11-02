// 请求用到的参数
        
        var prefix='';

        if(!tx_domain_url){
            var protocol = location.protocol === 'https:' ? 'https:' : 'http:';
            prefix= protocol + '//' + tx_bucket + '.cos.' + tx_region + '.myqcloud.com/';
        }else{
            prefix=tx_domain_url;
        }
        

        // 对更多字符编码的 url encode 格式
        var camSafeUrlEncode = function (str) {
            return encodeURIComponent(str)
                .replace(/!/g, '%21')
                .replace(/'/g, '%27')
                .replace(/\(/g, '%28')
                .replace(/\)/g, '%29')
                .replace(/\*/g, '%2A');
        };

        // 计算签名
        var getAuthorization = function (options, callback) {
            // var url = 'http://127.0.0.1:3000/sts';
            var url = '/txcloud_server/sts.php';
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onreadystatechange = function (e) {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var credentials;
                        try {
                            credentials = (new Function('return ' + xhr.responseText))().credentials;
                        } catch (e) {}
                        if (credentials) {
                            callback(null, {
                                XCosSecurityToken: credentials.sessionToken,
                                Authorization: CosAuth({
                                    SecretId: credentials.tmpSecretId,
                                    SecretKey: credentials.tmpSecretKey,
                                    Method: options.Method,
                                    Pathname: options.Pathname,
                                })
                            });
                        } else {
                            console.error(xhr.responseText);
                            callback('获取签名出错');
                        }
                    } else {
                        callback('获取签名出错');
                    }
                }
            };
            xhr.send();
        };

        // 上传文件
        var uploadFile = function (file, callback) {
            console.log(file);
            var file_suffix_arr =/\.[^\.]+$/.exec(file.name); //{0: ".jpg", groups: undefined,index: 3,input: "2-1.jpg",length: 1}
            var file_suffix=file_suffix_arr[0]; //.jpg
            
            var now=new Date();
            var year = now.getFullYear(); //得到年份
            var month = now.getMonth();//得到月份
            var date = now.getDate();//得到日期
            var hour = now.getHours();//得到小时
            var minu = now.getMinutes();//得到分钟
            var seconds = now.getSeconds();//得到秒
            month = month + 1;
            if (month < 10) month = "0" + month;
            if (date < 10) date = "0" + date;
            if (hour < 10) hour = "0" + hour;
            if (minu < 10) minu = "0" + minu;
            if (seconds < 10) seconds = "0" + seconds;
            var number = Math.ceil(Math.random()*1000); //生成0~1000范围内的随机数


            var time = year + month + date+hour+minu+seconds;

            
            var Key = time+"_"+number+file_suffix; // 这里指定上传目录和文件名
            getAuthorization({Method: 'POST', Pathname: '/'}, function (err, info) {
                var fd = new FormData();
                fd.append('key', Key);
                fd.append('signature', info.Authorization);
                fd.append('Content-Type', '');
                info.XCosSecurityToken && fd.append('x-cos-security-token', info.XCosSecurityToken);
                fd.append('file', file);
                var url = prefix;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.upload.onprogress = function (e) {
                    console.log('上传进度 ' + (Math.round(e.loaded / e.total * 10000) / 100) + '%');
                };
                xhr.onload = function () {
                    if (Math.floor(xhr.status / 100) === 2) {
                        var ETag = xhr.getResponseHeader('etag');
                        callback(null, {url: prefix + camSafeUrlEncode(Key).replace(/%2F/g, '/'), ETag: ETag,filename:Key});
                    } else {
                        callback('文件 ' + Key + ' 上传失败，状态码：' + xhr.status);
                    }
                };
                xhr.onerror = function () {
                    callback('文件 ' + Key + ' 上传失败，请检查是否没配置 CORS 跨域规则');
                };
                xhr.send(fd);
            });
        };