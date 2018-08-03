sudo ln -sf /home/box/web/etc/nginx.conf  /etc/nginx/sites-enabled/default
sudo /etc/init.d/nginx restart
touch /home/box/web/gunicorn.log
sudo ln -sf /home/box/web/etc/gunicorn_django.conf /etc/gunicorn.d/test
sudo service gunicorn restart

#sudo gunicorn -c /etc/gunicorn.d/django_conf.py ask.wsgi:application
