def app(environ, start_response):
        body = [(i+'\n') for i in environ['QUERY_STRING'].split('&')]
        start_response("200 OK", [("Content-Type", "text/plain")])
        return body
