CONFIG = {
    'mode': 'wsgi',
    'working_dir': '/path/to/my/app',
    'python': '/usr/bin/python3',
    'args': (
        '--bind=0.0.0.0:8080',
        '--workers=16',
        '--timeout=60',
        'hello:app',
    ),
}

def app(environ, start_response):
        body = [(i + '\n') for i in environ['QUERY_STRING'].split('&')]
        start_response("200 OK", [
            ("Content-Type", "text/plain"),
            ("Content-Length", str(len(body)))
        ])
        return body
