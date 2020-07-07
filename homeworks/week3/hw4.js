/*
## hw4：判斷迴文
[LIOJ1030 - 判斷迴文](https://oj.lidemy.com/problem/1030)
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
寫法1
function solve(lines) {
  let reverseStr = '';
  for (let i = lines.length - 1; i >= 0; i -= 1) {
    reverseStr += lines[i];
    if (lines === reverseStr) return true;
  } return false;
}

console.log(solve('abbbba')); // true
console.log(solve('ac')); // false
*/

function reverse(str) {
  let reverseStr = '';
  for (let i = str.length - 1; i >= 0; i -= 1) {
    reverseStr += str[i];
  }
  return reverseStr;
}

function solve(lines) {
  const str = lines[0];
  if (reverse(str) === str) {
    console.log('True');
  } else {
    console.log('False');
  }
}

// 以上通過LIOJ，以下測試資料格式有誤待解
solve('abbbba'); // true
solve('accccc'); // false
