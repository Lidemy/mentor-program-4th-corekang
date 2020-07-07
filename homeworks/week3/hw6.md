## hw1：好多星星

剛開始分別寫2個迴圈，將第1個迴圈值帶入第2個迴圈，但如果N很大，就要寫N個迴圈，重複的事可以再濃縮為迴圈，接著才想到，第1個迴圈裡再跑1個迴圈。從這個題目學習到基礎題型變化，不要馬上往龐雜方向思考。

## hw2：水仙花數

這題練習過，加上老師講解，比較有方向。但如果從頭摸索，會卡在 `sum += num ** digits;`。另外將LIOJ Sample Input轉為本機測試資料也發生障礙，測試很久，原來是長這樣： `solve(['5 200']);`，對資料型態轉換還很模糊。

## hw3：判斷質數

本機測試資料通過，但放到LIOJ就不通過，一時很難判斷哪裡出錯，例如：function isPrime(n)改為return true/false，才通過LIOJ，單獨測試return Composite/Prime則無法通過，必須使用函式預設回傳值true/false，才能接到回傳值的意思嗎？

另外是測試資料 `console.log(solve(['1', '2', '3', '4', '5']));`，答案卻是：Prime Prime Composite Prime undefined，第5個元素變成未定義，問題待解。

``` js
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
```

## hw4：判斷迴文

這題題型也見過，比較有概念些。但也是卡在測試資料，串接function solve(lines)就會卡很久。

目前很模糊怎麼將LIOJ Sample Input轉為本機測試資料，「單一數字是Number、一行多組字串（空白相隔）是陣列、多行字串是陣列」嗎？

``` js
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
// solve('abbbba'); // true
// solve('accccc'); // false
```

## hw5：聯誼順序比大小

這題完全卡住，還無法自己想出來，試做幾個解法後，只好先參考老師講解，後續再回來想。目前

有幾個問題：
1. 不懂 `if (k === -1)` 這段的語意？
2. 參考老師語法，ESLint顯示錯誤訊息： `a = b;` `b = temp` Assignment to function parameter 'a'  no-param-reassign，目前先忽略。
3. `const bLength = b.length;` 顯示 `TypeError: Cannot read property 'length' of undefined`，查了資料還是未解。
4. 老師提供第2、3組測試資料，第2組結果正常，還是我寫錯了什麼？第3組測試資料不知為何跑出2個B。

``` js
function showdown(a, b, k) {
  if (a === b) return 'DRAW';

  if (k === -1) { // 這段語意不懂待確認
    const temp = a;
    // eslint-disable-next-line
    a = b;
    // eslint-disable-next-line
    b = temp;
  }

  const aLength = a.length;
  const bLength = b.length; // TypeError: Cannot read property 'length' of undefined

  if (aLength !== bLength) {
    return aLength > bLength ? 'A' : 'B';
  }
  return a > b ? 'A' : 'B';
}

function solve(lines) {
  const line = Number(lines[0]);
  for (let i = 1; i <= line; i += 1) {
    const [a, b, k] = lines[i].split(' ');
    console.log(showdown(a, b, k));
  }
}

solve(['1', '2', '1']); // B
solve(['1', '111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111', '1']); // B
solve(['999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999', '1', '1']); // B B（應是A）
```
