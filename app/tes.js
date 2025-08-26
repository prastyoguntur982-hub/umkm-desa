import http from 'k6/http';
import { check } from 'k6';

export let options = {
  scenarios: {
    uji_ringan_menengah: {
      executor: 'constant-arrival-rate',
      rate: 10, // 10 requests per detik
      timeUnit: '1s',
      duration: '1m',
      preAllocatedVUs: 10,
      maxVUs: 100,
    },
    uji_menengah: {
      executor: 'constant-arrival-rate',
      rate: 25, // 25 requests per detik
      timeUnit: '1s',
      duration: '1m',
      preAllocatedVUs: 25,
      maxVUs: 200,
      startTime: '1m10s', // jeda antar skenario
    },
    uji_menengah_tinggi: {
      executor: 'constant-arrival-rate',
      rate: 50, // 50 requests per detik
      timeUnit: '1s',
      duration: '1m',
      preAllocatedVUs: 50,
      maxVUs: 300,
      startTime: '2m20s',
    },
    uji_beban_tinggi: {
      executor: 'constant-arrival-rate',
      rate: 100, // 100 requests per detik
      timeUnit: '1s',
      duration: '1m',
      preAllocatedVUs: 100,
      maxVUs: 400,
      startTime: '3m30s',
    },
  },
};

export default function () {
  let res = http.get('http://localhost/dinas-perdagangan/public/');
  check(res, {
    'status is 200': (r) => r.status === 200,
  });
}
