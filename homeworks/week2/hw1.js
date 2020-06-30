/*
## hw1：印出星星

給定 n（1<=n<=30），依照規律「印出」正確圖形

```
printStars(1)

正確輸出：
*
```

```
printStars(3)

正確輸出：
*
*
*
```

```
printStars(6)

正確輸出：
*
*
*
*
*
*
```
*/

//印出星星
function printStars(n) {
  for(var i = 1; i <= n; i++) {
    console.log('*');  //*是字串
  }
}

printStars(5);
