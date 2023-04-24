import { HttpHeaders } from '@angular/common/http';

const httpOptions = { headers: new HttpHeaders() };

httpOptions.headers
  = httpOptions.headers
    .set('Content-Type', 'application/json')
    .set('Accept', 'application/json; text/plain')
    .set('responseType', '');

// Url anterior a Api Gateway
// baseUrlBackend: "http://3.93.190.23/api",
const Config = {
  api: {   
    baseUrlBackend: "http://127.0.0.1:8001/api",
    options: httpOptions,
    timeout: 3000
  },
  aws:{
    baseUrlBucket: "http://127.0.0.1:8001/storage/"
  }
};

export { Config };
