def app(environ, start_response):
        body = [bytes('\r\n'.join(environ['QUERY_STRING'].split('&')), encoding="utf8")]
        start_response("200 OK", [("Content-Type", "text/plain")])
        return body
