/*
## hw2：水仙花數
[LIOJ1025 - 水仙花數](https://oj.lidemy.com/problem/1025)
*/

/*
LIOJ標準輸入符合ESLint
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

function countDigits(n) {
  if (n === 0) { return 1; } // 可不用{}
  let result = 0;
  let n1 = n;
  while (n1 !== 0) {
    // n = Math.floor(n / 10);
    // 7:5  error  Assignment to function parameter 'n'  no-param-reassign
    // let n = Math.floor(n / 10);
    // 39:9  error  'n' is already declared in the upper scope    no-shadow
    // 39:9  error  'n' is never reassigned. Use 'const' instead  prefer-const
    // 39:24  error  'n' was used before it was defined           no-use-before-define
    n1 = Math.floor(n1 / 10);
    result += 1;
  }
  return result;
}

function isNarcissistic(n) {
  let n1 = n;
  const digits = countDigits(n);
  let sum = 0;
  while (n1 !== 0) {
    const num = n1 % 10;
    sum += num ** digits;
    n1 = Math.floor(n1 / 10);
  }
  if (sum === n) {
    return true;
  } return false;
}

/*
解法1：無法取得資料
function solve(lines) {
  for (let i = 0; i < lines.length; i += 1) {
    const temp = lines[i].split(' ');
    const m1 = Number(temp[0]);
    const m2 = Number(temp[1]);
    isNarcissistic(i >= m1 && i <= m2);
  }
    console.log(i);
}
*/

function solve(lines) {
  const temp = lines[0].split(' ');
  const m1 = Number(temp[0]);
  const m2 = Number(temp[1]);
  for (let i = m1; i <= m2; i += 1) {
    if (isNarcissistic(i)) {
      console.log(i);
    }
  }
}

// 測試資料
// console.log(countDigits(1));
// console.log(countDigits(9));
// console.log(countDigits(1000));
// console.log(countDigits(9999999999));
// console.log(isNarcissistic(0));
// console.log(isNarcissistic(9));
// console.log(isNarcissistic(1634));
// console.log(isNarcissistic(1635));

// solve('5', '200'); //測試資料格式錯誤
// console.log(solve['5', '200']); //測試資料格式錯誤
solve(['5 200']);
