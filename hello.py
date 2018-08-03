def application(environ, start_response):
    args = environ['QUERY_STRING'].split('&')
    # data = '127.0.0.1/?a=1&a=2&b=3'
    ret = ''
    for arg in args:
        ret = ret + arg + '\n'
    start_response("200 OK", [("Content-Type", "text/plain")])                  
    return [bytes(ret, 'utf-8')] 