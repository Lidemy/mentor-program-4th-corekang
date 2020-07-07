/*
## hw3：判斷質數
[LIOJ1020 - 判斷質數](https://oj.lidemy.com/problem/1020)
*/

/*
const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

rl.on('close', () => {
  solve(lines); // 19:3   error  'solve' was used before it was defined
});
*/

/*
單獨測試正確
function isPrime(n) {
  if (n === 1) return 'Composite';
  for (let i = 2; i <= n - 1; i += 1) {
    if (n % i === 0) return 'Composite';
  } return 'Prime';
}
*/

// 改為return true/false，通過LIOJ
function isPrime(n) {
  if (n === 1) return false;
  for (let i = 2; i <= n - 1; i += 1) {
    if (n % i === 0) return false;
  } return true;
}

function solve(lines) {
  for (let i = 1; i < lines.length; i += 1) {
    console.log(isPrime(Number(lines[i])) ? 'Prime' : 'Composite');
  }
}

// 測試資料
// console.log('isPrime(1)', isPrime(1));
// console.log('isPrime(2)', isPrime(2));
// console.log('isPrime(3)', isPrime(3));
// console.log('isPrime(4)', isPrime(4));
// console.log('isPrime(5)', isPrime(5));
// 加入solve(lines)，測試資料為陣列：
console.log(solve(['1', '2', '3', '4', '5'])); // 答案卻是：Prime Prime Composite Prime undefined  //待解
