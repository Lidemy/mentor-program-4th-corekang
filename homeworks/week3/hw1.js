/*
## hw1：好多星星
[LIOJ1021 - 好多星星](https://oj.lidemy.com/problem/1021)
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

function solve(lines) { // 22:16  error  'lines' is already declared in the upper scope
  // const a = lines[i];
  for (let i = 1; i <= lines; i += 1) {
    let manyStar = '';
    for (let n = 1; n <= i; n += 1) {
      manyStar += '*';
    }
    console.log(manyStar);
  }
}

solve(5);
