## hw1：好多星星

剛開始分別寫2個迴圈，將第1個迴圈值帶入第2個迴圈，但如果N很大，就要寫N個迴圈，重複的事可以再濃縮為迴圈，接著才想到，第1個迴圈裡再跑1個迴圈。從這個題目學習到基礎題型變化，不要馬上往龐雜方向思考。

## hw2：水仙花數

這題練習過，加上老師講解，比較有方向。但如果從頭摸索，會卡在 `sum += num ** digits;`。另外將LIOJ Sample Input轉為本機測試資料也發生障礙，測試很久，原來是長這樣： `solve(['5 200']);`，對資料型態轉換還很模糊。

## hw3：判斷質數

本機測試資料通過，但放到LIOJ就不通過，一時很難判斷哪裡出錯，例如：function isPrime(n)改為return true/false，才通過LIOJ，單獨測試return Composite/Prime則無法通過，必須使用函式預設回傳值true/false，才能接到回傳值的意思嗎？

另外是測試資料 `console.log(solve(['1', '2', '3', '4', '5']));`，答案卻是：Prime Prime Composite Prime undefined，第5個元素變成未定義。原本測試資料格式錯誤，改為cat input3.txt | node hw3.js，input3.txt貼入範例輸出，輸出正確。

## hw4：判斷迴文

這題題型也見過，比較有概念些。但也是卡在測試資料，串接function solve(lines)就會卡很久。

目前很模糊怎麼將LIOJ Sample Input轉為本機測試資料，「單一數字是Number、一行多組字串（空白相隔）是陣列、多行字串是陣列」嗎？原本測試資料格式錯誤，改為solve(['ac']);，輸出正確。

## hw5：聯誼順序比大小

這題完全卡住，還無法自己想出來，試做幾個解法後，只好先參考老師講解，後續再回來想。目前

有幾個問題：
1. 不懂 `if (k === -1)` 這段的語意？
2. 參考老師語法，ESLint顯示錯誤訊息： `a = b;` `b = temp` Assignment to function parameter 'a'  no-param-reassign，目前先忽略。
3. `const bLength = b.length;` 顯示 `TypeError: Cannot read property 'length' of undefined`，查了資料還是未解。
4. 老師提供第2、3組測試資料，第2組結果正常，還是我寫錯了什麼？第3組測試資料不知為何跑出2個B。

經過老師詳細說明，原本測試資料格式錯誤，改為cat input5.txt | node hw5.js，input5.txt貼入範例輸出，輸出正確。
