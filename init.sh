sudo ﻿ln -sf ~/web/etc/nginx.conf  /etc/nginx/sites-enabled/tdefault
sudo /etc/init.d/nginx restart
sudo ln -sf ~/web/etc/gunicorn.conf   /etc/gunicorn.d/test
sudo /etc/init.d/gunicorn restart
﻿sudo /etc/init.d/mysql start﻿