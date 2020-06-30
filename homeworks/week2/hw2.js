/*
## hw2：首字母大寫
給定一字串，把第一個字轉成大寫之後「回傳」，若第一個字不是英文字母則忽略。

```
capitalize('nick')
正確回傳值：Nick

capitalize('Nick')
正確回傳值：Nick

capitalize(',hello')
正確回傳值：,hello
```
*/

//首字母大寫
function capitalize(str) {
  if (str[0] >= 'a' && str[0] <= 'z') {  //字串比大小
      return str[0].toUpperCase() + str.slice(1);
  } else {
      return str;
  }
}

console.log(capitalize('hello'));
