sudo chmod -R a+rw ~/web
sudo rm /etc/nginx/sites-enabled/default
sudo ln -sf /home/box/web/etc/nginx.conf /etc/nginx/sites-enabled/default
sudo /etc/init.d/nginx restart
touch /home/box/web/gunicorn.log
sudo ln -sf /home/box/web/etc/gunicorn.conf /etc/gunicorn.d/guni
sudo ln -sf /home/box/web/etc/gunicorn_django.conf /etc/gunicorn.d/test
sudo service gunicorn restart


