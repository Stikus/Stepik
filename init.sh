sudo chmod -R a+rw ~/web
sudo rm /etc/nginx/sites-enabled/default
sudo ln -sf /home/box/web/etc/nginx.conf /etc/nginx/sites-enabled/default
sudo /etc/init.d/nginx restart
touch /home/box/web/gunicorn.log
#sudo ln -sf /home/box/web/etc/hello.py /etc/gunicorn.d/hello.py
sudo ln -sf /home/box/web/etc/django_conf.py /etc/gunicorn.d/django_conf.py
#sudo gunicorn -c /etc/gunicorn.d/hello.py hello:application
#sudo gunicorn -c /etc/gunicorn.d/django_conf.py django_conf:application
sudo gunicorn -c /etc/gunicorn.d/django_conf.py ask.wsgi:application
