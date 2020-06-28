/*
## hw5：自己的函式自己寫
其實仔細思考的話，你會發現那些陣列內建的函式你其實都寫得出來，因此這一題就是要讓你自己動手實作那些函式！

我們要實作的函式有兩個：join 以及 repeat。（再次強調，這一題要你自己實作這些函式，所以你不會用到內建的`join`以及`repeat`）

join 會接收兩個參數：一個陣列跟一個字串，會在陣列的每個元素中間插入一個字串，最後回傳合起來的字串。

repeat 的話就是回傳重複 n 次之後的字串。

```
join([1, 2, 3], '')，正確回傳值：123
join(["a", "b", "c"], "!")，正確回傳值：a!b!c
join(["a", 1, "b", 2, "c", 3], ',')，正確回傳值：a,1,b,2,c,3

repeat('a', 5)，正確回傳值：aaaaa
repeat('yoyo', 2)正確回傳值：yoyoyoyo
```
*/

/*
//執行結果 abcd!
function join(arr, concatStr) {
  let arrJoin = [0];
  for (let i = 1; i <= arr.length; i++) {
    arrJoin = arr + concatStr;
  }
  return arrJoin;
}
*/

/*
//陣列含2個元素以上（不知為何無法產生a!）
function join(arr, concatStr) {
  let arrJoin = arr[0];
  for (let i = 1; i < arr.length; i++) {
    arrJoin += concatStr + arr[i];
  }
  return arrJoin;
}
*/

//陣列含1個元素以上（可以a!）
function join(arr, concatStr) {
  let arrJoin = arr[0];
  if (arr.length <= 1) {
    arrJoin = arr[0] + concatStr;
    return arrJoin;
  } else {
      for (let i = 1; i < arr.length; i++) {
      arrJoin += concatStr + arr[i];
    }
    return arrJoin;
  }
}

function repeat(str, times) {
  let strRepeat = '';
  for (let i = 1; i <= times; i++) {
    strRepeat += str;  //strRepeat => str重複tiimes次
    //+=分開，CLI > SyntaxError: Unexpected token '='
    //console.log(strRepeat);  //CLI > 顯示遞增字串階層（分行） a aa aaa aaaa aaaaa
  }
  return strRepeat;
}

console.log(join(['a'], '!')); 
console.log(join([1, 2, 3, 4], '!'));  //學生增加測試
console.log(repeat('a', 5));
