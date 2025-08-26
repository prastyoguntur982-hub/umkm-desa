import http from 'k6/http';
import { sleep, check } from 'k6';

export const options = {
  stages: [
    { duration: '10s', target: 20 },   // Naik ke 20 user dalam 10 detik
    { duration: '10s', target: 50 },   // Naik ke 50 user dalam 10 detik
    { duration: '20s', target: 100 },  // Naik ke 100 user dalam 20 detik
    { duration: '30s', target: 100 },  // Stabil di 100 user selama 30 detik
    { duration: '10s', target: 0 },    // Turun ke 0 user dalam 10 detik
  ],
};

export default function () {
  let res = http.get('http://localhost:8000');
  check(res, {
    'status is 200': (r) => r.status === 200,
  });
  sleep(1);
}
