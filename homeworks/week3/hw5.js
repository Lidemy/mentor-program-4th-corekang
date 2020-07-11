/*
## hw5：聯誼順序比大小
[LIOJ1004 - 聯誼順序比大小](https://oj.lidemy.com/problem/1004)
*/

const readline = require('readline');

const rl = readline.createInterface({
  input: process.stdin,
});

const lines = [];

rl.on('line', (line) => {
  lines.push(line);
});

rl.on('close', () => {
  solve(lines); /* eslint no-use-before-define: 0 */
});

function showdown(a, b, k) {
  if (a === b) return 'DRAW';

  if (k == -1) { /* eslint eqeqeq: 0 */ // 比小 ==（=== 則失靈，答案A變B，因為k是字串）
    // Expected '===' and instead saw '=='  eqeqeq
    const temp = a;
    a = b; /* eslint no-param-reassign: 0 */
    b = temp; /* eslint no-param-reassign: 0 */
  }

  const aLength = a.length;
  const bLength = b.length;

  if (aLength !== bLength) {
    return aLength > bLength ? 'A' : 'B';
  }
  return a > b ? 'A' : 'B';
}

function solve(lines) {
  const line = Number(lines[0]); /* eslint no-shadow: 0 */
  for (let i = 1; i <= line; i += 1) {
    const [a, b, k] = lines[i].split(' ');
    console.log(showdown(a, b, k));
  }
}

// 測試資料（測試時移除標準輸入註解）
// cat input5.txt | node hw5.js
