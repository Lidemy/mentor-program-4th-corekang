## 前四週心得與解題心得
### 前四週心得

加入計畫至今，成長很多，雖然成長緩慢。成長緩慢主要和自己有關，直接考驗生活作息、體能狀態，也與專注力、理解度正相關。

目前最沒把握的部分是 JavaScript 解題思考、API 串接。

JavaScript 解題練習很慢，在於不習慣數學邏輯思考，比較適合自己的方式是跟著老師實作再重複練習，但不確定如何區分背誦和理解。之前未設定解題停損點，可能一題就卡住半天，現在改為兩小時以內，嘗試所知解法還是打結的話，就看作業檢討，過一陣子再重新解題，透過模仿學習慢慢朝向觀察學習。有時過一段時間，也會感覺學習到的內容發生奇妙的連結和轉化，自然就懂了（應該是背景知識加強的關係）。

API 串接問題在於對文法不熟悉，還沒讀懂 [Request - Simplified HTTP client](https://github.com/request/request)、不太知道怎麼讀 API 文件，就開始寫作業，一開始很茫然，靜下心先想存取目標是什麼，再想怎麼寫出符合格式的請求信。有個同學在直播提出怎麼看技術文件，這個問題很實用，每次看老師可以快速判斷閱讀哪些關鍵內容，這就是實力！希望提到重要技術文件時，老師可以帶我們多些導讀，例如文件大綱、重點概念、常用語法、次要閱讀重點、哪些可以先略過不讀等等（會不會要求太多了）。

很榮幸可以參加 Lidemy 程式導師實驗計畫第四期，去年和第三期擦身而過（剛得知計畫但已報名截止2天），後來得知老師閉關，心裡默默期待，可能匯集太多人的碎碎念力，總算開班了。從老師的文章可以學習到許多有趣的觀察點、思考線，而不是技術文章而已，對自己的人生也有啟發。我有個妹妹和老師年紀接近，擔任軟體工程師，我常和他聊到這個計畫、有趣的學習，他也越來越有興趣，好奇老師這麼年輕卻已這麼多歷練。一路學習以來，越來越可以體會課程規劃的深意，若是自學很難達成，光是辨別學習優先順序就非常不易，更難判斷學習切入點、停損點，而老師還使用了穿越法（不知道如何說明這個感覺），非常感謝老師、助教分享自身經驗，希望自己可以更勇於提問，更懂得如何問出好問題，我會繼續努力的。

### Lidemy HTTP Challenge 解題心得

遊戲設計難易度交錯，而非進階，這樣的構想不知道是特地或是不小心，或是學生各有難易度表，總之覺得一下子開心一下子擠眉，無意間提升破關的動力，也比較把焦點專注於概念、功能理解。有些問題如下，請問助教想法。（如果問題太大，或是有建議的問題關鍵字、參考資料）

第2關思考 id 是否需要帶入相對路徑？想想 API 參數應該是全域通用，類似資料庫主索引鍵，與全域變數概念是否有關呢？

第4關尋找書名關鍵字「世界」：https://lidemy-http-challenge.herokuapp.com/api/books?q=世界 ，但是第8關尋找書名關鍵字「我」：https://lidemy-http-challenge.herokuapp.com/api/v2/books?q=我 ，顯示 `Invalid Authorization token`，嘗試在查詢字串加入授權但無效：https://lidemy-http-challenge.herokuapp.com/api/v2/books?q=我&Authorization=Basic+YWRtaW46YWRtaW4xMjM= 。不知道是否哪裡錯誤？或是授權必須透過 Request？

第4關、第8關同樣查詢中文字串，但是第8關必須使用內建函式才能存取，`const keyword = encodeURIComponent('我')`。

關於 User Agent 的應用很陌生，一開始的困難在於不知道搜尋哪些問題關鍵字，也沒想到會有相關 App 或 Plugin。第9關模擬／假裝透過瀏覽器 IE6 發送，好在 User-Agent Switcher for Chrome 這類服務很容易搜尋到。第14關辨識搜尋引擎，這題還不太理解這個設定的實際影響，這屬於搜尋引擎優化的一部分嗎？

第13關指定代理伺服器，我使用的方法是直接修改 `Chrome > Settings > Advanced > System > Open your computer's proxy settings > Proxies > Secure Web Proxy(HTTPS) > 121.58.246.247：8080`（搜尋菲律賓代理伺服器列表，逐一套用測試），設定後重跑 https://lidemy-http-challenge.herokuapp.com/api/v3/logs ，直到過關。不過，對於手動設定感到疑惑，是否有自動判斷的方式呢？

***

- [X] 入口介紹：https://lidemy-http-challenge.herokuapp.com/start
>安安，歡迎來到 Lidemy HTTP Challenge。
>
>這裡一共有 10 道關卡，每一關的網址皆為 /lvX，X 即為關卡的數字。  
>但只知道網址是沒有用的，需要搭配正確的 token 才能順利進入關卡，傳入 token 的方式為 query string，例如 /lv1?token=xxx。
>
>另外，為了讓你方便辨別這是 token，token 的內容一定是用一個大括弧刮起來的字串。  
>每一關都會有提示，只要按照提示照著做，就能拿到前往下一關的 token。
>
>你可以用任何你擅長的工具來通關，只靠瀏覽器的話有些關卡是沒辦法通過的喔！
>
>準備好了嗎？
>
>第一關的 token 為：{GOGOGO}
>
>附註：所以第一關網址為 /lv1?token={GOGOGO}，不是 /lv1?  token=GOGOGO，之後的關卡也是一樣  
>如果你需要提示的話，在網址最後面加上 &hint=1 就會看到提示了，例如說：/lv1?token={GOGOGO}&hint=1
>
><details>
>  <summary>提示1</summary>
>  
>  用 GET 方式傳送的資料會被附在 URL 上面當作，所以傳了 token 就會變 ?token=xxx
>
>  現在只要多傳一個 name 就行囉
>
>  ?token=xxx&name=xxx
></details>

***

- [X] 前進第1關：https://lidemy-http-challenge.herokuapp.com/lv1?token={GOGOGO}
- [X] 第1關關卡介紹：
>啊...好久沒有看到年輕人到我這個圖書館了，我叫做 lib，是這個圖書館的管理員  
>很開心看到有年輕人願意來幫忙，最近圖書館剛換了資訊系統，我都搞不清楚怎麼用了...  
>這是他們提供給我的文件，我一個字都看不懂，但對你可能會有幫助：https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba  
>
>先把這文件放一旁吧，這個待會才會用到  
>你叫做什麼名字呢？用 GET 方法跟我說你的 name 叫做什麼吧！  
>除了 token 以外順便把 name 一起帶上來就可以了
- [X] 取得導覽手冊：[圖書館資訊系統 API 文件](https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba)
- [X] 向圖書館管理員自我介紹：https://lidemy-http-challenge.herokuapp.com/lv1?token={GOGOGO}&name=corekang
- [X] 取得第2關 token：
>啊...原來你叫 corekang 啊！下一關的 token 是 {HellOWOrld}

***

- [X] 前進第2關：https://lidemy-http-challenge.herokuapp.com/lv2?token={HellOWOrld}
- [X] 第2關關卡介紹：
>我前陣子在整理書籍的時候看到了一本我很喜歡的書，可是現在卻怎麼想都想不起來是哪一本...  
>我只記得那本書的 id 是兩位數，介於 54~58 之間，你可以幫幫我嗎？  
>找到是哪一本之後把書的 id 用 GET 傳給我就行了。
>
><details>
>  <summary>提示1</summary>
> 
>  還記得之前第一關給的文件嗎？要從文件裡面選到適當的 API 並找出書籍
> 
>  不確定是哪本書的話可以多試幾次看看
> 
>  「把書的 id 用 GET 傳給我」跟上一關的「用 GET 方法跟我說你的 name 叫什麼」是一樣的
> 
>  除了 token 以外，要多帶一個 id 上來
></details>
- [X] 查閱[圖書館資訊系統 API 文件](https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba)，獲取單一書籍方法
- [X] 幫圖書館管理員找1本書：
> - [ ] https://lidemy-http-challenge.herokuapp.com/lv2?token={HellOWOrld}&id=54 ...好像不是這本書耶...
> - [ ] https://lidemy-http-challenge.herokuapp.com/lv2?token={HellOWOrld}&id=55 ...好像不是這本書耶...
> - [X] https://lidemy-http-challenge.herokuapp.com/lv2?token={HellOWOrld}&id=56 ...啊！就是這本書，太謝謝你了。下一關的 token 為：{5566NO1}
- [X] 取得第3關 token：
>下一關的 token 為：{5566NO1}

***

- [X] 前進第3關：https://lidemy-http-challenge.herokuapp.com/lv3?token={5566NO1}
- [X] 第3關關卡介紹：
>真是太感謝你幫我找到這本書了！
>
>剛剛在你找書的時候有一批新的書籍送來了，是這次圖書館根據讀者的推薦買的新書，其中有一本我特別喜歡，想要優先上架。  
>書名是《大腦喜歡這樣學》，ISBN 為 9789863594475。
>
>就拜託你了。  
>新增完之後幫我把書籍的 id 用 GET 告訴我。
>
><details>
>  <summary>提示1</summary>
> 
>  還記得之前第一關給的文件嗎？要從文件裡面選到適當的 API 並新增書籍
> 
>  「把書籍的 id 用 GET 告訴我」跟上一關的「把書的 id 用 GET 傳給我」是一樣的喔
> 
>  除了 token 以外，要多帶一個 id 上來
></details>
- [X] 查閱[圖書館資訊系統 API 文件](https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba)，新增書籍方法
- [X] 查閱[Request - Simplified HTTP client #Forms](https://github.com/request/request#forms)，選擇請求資料方法
- [X] 幫圖書館管理員上架1本書：

``` js
// request.post({url:'http://service.com/upload', form: {key:'value'}}, function(err,httpResponse,body){ /* ... */ })

const request = require('request');

request.post({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/books',
  form: {
    ISBN: '9789863594475',
    name: '大腦喜歡這樣學',
  }
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

>CLI > node code.js > {"message":"新增成功","id":"1989"}
- [X] 完成上架，回傳書籍 id 給圖書館管理員：https://lidemy-http-challenge.herokuapp.com/lv3?token={5566NO1}&id=1989
- [X] 取得第4關 token：
>這樣子讀者就能趕快看到這本新書了，謝謝！下一關的 token 為 {LEarnHOWtoLeArn}

***

- [X] 前進第4關：https://lidemy-http-challenge.herokuapp.com/lv4?token={LEarnHOWtoLeArn}
- [X] 第4關關卡介紹：
>我翻了一下你之前幫我找的那本書，發現我記錯了...這不是我朝思暮想的那一本。
>
>我之前跟你講的線索好像都是錯的，我記到別本書去了，真是抱歉啊。
>
>我記得我想找的那本書，書名有：「世界」兩字，而且是村上春樹寫的，可以幫我找到書的 id 並傳給我嗎？
>
><details>
>  <summary>提示1</summary>
> 
>  還記得之前第一關給的文件嗎？要從文件裡面選到適當的 API 並找到書籍
>
>  「找到書的 id 並傳給我」跟上一關的「把書籍的 id 用 GET 告訴我」是一樣的喔
>
>  除了 token 以外，要多帶一個 id 上來
></details>
- [X] 查閱[圖書館資訊系統 API 文件](https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba)，獲取所有書籍，查詢書籍範例：/books?q=hello
- [X] 尋找書名關鍵字「世界」：https://lidemy-http-challenge.herokuapp.com/api/books?q=世界
>[{"id":2,"name":"當我想你時，全世界都救不了我","author":"肆一","ISBN":"5549173495"},{"id":27,"name":"從你的全世界路過","author":"張嘉佳","ISBN":"8426216529"},{"id":79,"name":"世界末日與冷酷異境","author":"村上春樹","ISBN":"9571313408"},{"id":90,"name":"文學的40堂公開課：從神話到當代暢銷書，文學如何影響我們、帶領我們理解這個世界","author":"約翰．薩德蘭","ISBN":"7978376866"}]
- [X] 尋找村上村樹，回傳書籍 id 給圖書館管理員：https://lidemy-http-challenge.herokuapp.com/lv4?token={LEarnHOWtoLeArn}&id=79
- [X] 取得第5關 token：
>沒錯！這次我很確定了，就是這本！下一關的 token 為 {HarukiMurakami}

***

- [X] 前進第5關：https://lidemy-http-challenge.herokuapp.com/lv5?token={HarukiMurakami}
- [X] 第5關關卡介紹：
>昨天有個人匆匆忙忙跑過來說他不小心捐錯書了，想要來問可不可以把書拿回去。
>
>跟他溝通過後，我就把他捐過來的書還他了，所以現在要把這本書從系統裡面刪掉才行。
>
>那本書的 id 是 23，你可以幫我刪掉嗎？
>
><details>
>  <summary>提示1</summary>
> 
>  還記得之前第一關給的文件嗎？要從文件裡面選到適當的 API 並刪除書籍
>
>  「若是有做對的話，就會拿到下一關的 token 囉
></details>
- [X] 查閱[圖書館資訊系統 API 文件](https://gist.github.com/aszx87410/3873b3d9cbb28cb6fcbb85bf493b63ba)，刪除書籍方法
- [X] 幫圖書館管理員刪除1本書：

``` js
const request = require('request');

request.delete({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/books/23',
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

- [X] 取得第6關 token：
>CLI > node code.js > {"message":"\n咦...是刪掉了沒錯，但總覺得哪裡怪怪的，算了，先這樣吧！下一關的 token 為 {CHICKENCUTLET}\n"}

***

- [X] 前進第6關：https://lidemy-http-challenge.herokuapp.com/lv6?token={CHICKENCUTLET}
- [X] 第6關關卡介紹：
>我終於知道上次哪裡怪怪的了！
>
>照理來說要進入系統應該要先登入才對，怎麼沒有登入就可以新增刪除...
>這太奇怪了，我已經回報給那邊的工程師了，他們給了我一份新的文件：https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a。
>
>這邊是帳號密碼，你先登入試試看吧，可以呼叫一個 /me 的 endpoint，裡面會給你一個 email。
>把 email 放在 query string 上面帶過來，我看看是不是對的。
>
>帳號：admin
>密碼：admin123
>
><details>
>  <summary>提示1</summary>
> 
>  從這關以後要開始用這份新的文件了
>
>  關於驗證方式請 Google：http basic authorization
></details>
- [X] 更新導覽手冊：[圖書館資訊系統 API 文件 v2](https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a)
- [X] 查閱[圖書館資訊系統 API 文件 v2](https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a)，獲取個人資訊方法
- [X] 透過 https://www.base64encode.org/ 進行 base64 編碼：admin:admin123 => YWRtaW46YWRtaW4xMjM=
- [X] 取得 email：

``` js
const request = require('request');

request.get({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/me',
  headers: {
    Authorization: 'Basic YWRtaW46YWRtaW4xMjM=',
  }
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

>CLI > node code.js > {"username":"admin","email":"lib@lidemy.com"}
- [X] 驗證 email：https://lidemy-http-challenge.herokuapp.com/lv6?token={CHICKENCUTLET}&email=lib@lidemy.com
- [X] 取得第7關 token：
>對對對，就是這個，這樣才對嘛！下一關的 token 為 {SECurityIsImPORTant}

***

- [X] 前進第7關：https://lidemy-http-challenge.herokuapp.com/lv7?token={SECurityIsImPORTant}
- [X] 第7關關卡介紹：
>那邊的工程師說系統整個修復完成了，剛好昨天我們發現有一本書被偷走了...  
>這本書我們已經買第五次了，每次都被偷走，看來這本書很熱門啊。  
>我們要把這本書從系統裡面刪掉，就拜託你了。  
>
>對了！記得要用新的系統喔，舊的已經完全廢棄不用了。  
>
>書的 id 是 89。
>
><details>
>  <summary>提示1</summary>
> 
>  這關記得要用上一關給的新的系統，API v2，不是原本的 API 喔
>
>  找到正確的書籍並刪除即可
></details>
- [X] 查閱[圖書館資訊系統 API 文件 v2](https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a)，刪除書籍
- [X] 幫圖書館管理員刪除1本書：
``` js
const request = require('request');

request.delete({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/books/89',
  headers: {
    Authorization: 'Basic YWRtaW46YWRtaW4xMjM=', // 漏放則顯示 Invalid Authorization token
  }
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

- [X] 取得第8關 token：
>CLI > node code.js > {"message":"\n希望下一次進這本書的時候不會再被偷走了。下一關的 token 為 {HsifnAerok}\n"}

***

- [X] 前進第8關：https://lidemy-http-challenge.herokuapp.com/lv8?token={HsifnAerok}
- [X] 第8關關卡介紹：
>我昨天在整理書籍的時候發現有一本書的 ISBN 編號跟系統內的對不上，仔細看了一下發現我當時輸入系統時 key 錯了。  
>哎呀，人老了就是這樣，老是會看錯。  
>
>那本書的名字裡面有個「我」，作者的名字是四個字，key 錯的 ISBN 最後一碼為 7，只要把最後一碼改成 3 就行了。  
>對了！記得要用新的系統喔，舊的已經完全廢棄不用了。
>
><details>
>  <summary>提示1</summary>
> 
>  這關記得要用之前給的新的系統，API v2，不是原本的 API 喔
>
>  找到正確的書籍並更新即可
></details>
- [X] 查閱[圖書館資訊系統 API 文件 v2](https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a)，獲取所有書籍方法，查詢書籍範例：/books?q=hello；更改書籍資訊方法
- [X] 尋找書名關鍵字「我」：https://lidemy-http-challenge.herokuapp.com/api/v2/books?q=我

``` js
const request = require('request');
const keyword = encodeURIComponent('我')

request.get({
  url: `https://lidemy-http-challenge.herokuapp.com/api/v2/books?q=${keyword}`,
  headers: {
    Authorization: 'Basic YWRtaW46YWRtaW4xMjM=',
  }
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

>CLI > node code.js > [{"id":2,"name":"當我想你時，全世界都救不了我","author":"肆一","ISBN":"5549173495"},{"id":3,"name":"我殺的人與殺我的人","author":"東山彰良","ISBN":"9262228645"},{"id":7,"name":"你已走遠，我還在練習道別","author":"渺渺","ISBN":"3722233689"},{"id":9,"name":"你是我最熟悉的陌生人","author":"Middle","ISBN":"9765734253"},{"id":22,"name":"我輩中人：寫給中年人的情書","author":"張曼娟","ISBN":"7241428897"},{"id":38,"name":"我和我追逐的垃圾車","author":"謝子凡","ISBN":"7797349452"},{"id":57,"name":"我的櫻花戀人","author":"宇山佳佑","ISBN":"2947749939"},{"id":60,"name":"你走慢了我的時間","author":"張西","ISBN":"8811544334"},{"id":66,"name":"我是許涼涼","author":"李維菁","ISBN":"8389193464"},{"id":72,"name":"日日好日：茶道教我的幸福15味【電影書腰版】","author":"森下典子","ISBN":"9981835427"},{"id":90,"name":"文學的40堂公開課：從神話到當代暢銷書，文學如何影響我們、帶領我們理解這個世界","author":"約翰．薩德蘭","ISBN":"7978376866"},{"id":95,"name":"我想吃掉你的胰臟【電影珍藏版】","author":"住野夜","ISBN":"2615985356"},{"id":100,"name":"慢情書：我們會在更好的地方相遇嗎？","author":"林達陽","ISBN":"7418527246"}]
- [X] 尋找4個字作者姓名、ISBN末碼7：{"id":72,"name":"日日好日：茶道教我的幸福15味【電影書腰版】","author":"森下典子","ISBN":"9981835427"}
- [X] 修改 ISBN：

``` js
const request = require('request');

request.patch({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/books/72',
  headers: {
    Authorization: 'Basic YWRtaW46YWRtaW4xMjM=',
  },
  form: {
    ISBN: 9981835423,
  },
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

- [X] 取得第9關 token：
>CLI > node code.js > {"message":"\n希望之後他們能引進語音輸入系統，我就只要講講話就好。下一關的 token 為 {NeuN}\n"}

***

- [X] 前進第9關：https://lidemy-http-challenge.herokuapp.com/lv9?token={NeuN}
- [X] 第9關關卡介紹：
>API 文件裡面有個獲取系統資訊的 endpoint 你記得嗎？  
>工程師跟我說這個網址不太一樣，用一般的方法是沒辦法成功拿到回傳值的。
>
>想要存取的話要符合兩個條件：  
>1. 帶上一個 X-Library-Number 的 header，我們圖書館的編號是 20
>2. 伺服器會用 user agent 檢查是否是從 IE6 送出的 Request，不是的話會擋掉
>
>順利拿到系統資訊之後應該會有個叫做 version 的欄位，把裡面的值放在 query string 給我吧。
>
><details>
>  <summary>提示1</summary>
> 
>  試著去想想看，伺服器是怎麼知道 request 是什麼版本的瀏覽器？
>
>  只要能知道伺服器是怎麼檢查的，就有方法可以騙過它，原本的敘述裡面也有給關鍵字了
></details>
- [X] 查閱[圖書館資訊系統 API 文件 v2](https://gist.github.com/aszx87410/1e5e5105c1c35197f55c485a88b0328a)，獲取獲取系統資訊方法
- [X] 思考點：因為不可能透過 IE6 發送 Request，必須避免檢查或取巧通過檢查。透過 [User-Agent Switcher for Chrome](https://chrome.google.com/webstore/detail/user-agent-switcher-for-c/djflhoibgkdhkhhcedjiklpkjnoahfmg) 模擬 IE6，再透過 相關網站服務查詢 User Agent。

``` js
const request = require('request');

request.get({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v2/sys_info',
  headers: {
    Authorization: 'Basic YWRtaW46YWRtaW4xMjM=',
    'X-Library-Number': 20,
    'User-Agent': 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; WOW64; Trident/4.0; SLCC1)',
  },
  form: {
    ISBN: 9981835423,
  },
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

>CLI > node code.js > {"message":"success","version":"1A4938Jl7","owner":"lib","createdAt":"121290329301"}
- [X] 回傳瀏覽器 version 給圖書館管理員：https://lidemy-http-challenge.herokuapp.com/lv9?token={NeuN}&version=1A4938Jl7
- [X] 取得第10關 token：
>限制這麼多都被你突破了，真有你的。要不要考慮以後來我們圖書館當工程師啊？下一關的 token 為 {duZDsG3tvoA}

***

- [X] 前進第10關：https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}
- [X] 第10關關卡介紹：
>時間過得真快啊，今天是你在這邊幫忙的最後一天了。
>
>我們來玩個遊戲吧？你有玩過猜數字嗎？
>
>出題者會出一個四位數不重複的數字，例如說 9487。  
>你如果猜 9876，我會跟你說 1A2B，1A 代表 9 位置對數字也對，2B 代表 8 跟 7 你猜對了但位置錯了。  
>
>開始吧，把你要猜的數字放在 query string 用 num 當作 key 傳給我。
>
><details>
>  <summary>提示1</summary>
> 
>  「把你要猜的數字放在 query string 用 num 當作 key 傳給我」就是在 URL 加上 &num=1234
>
>  就可以開始玩猜數字囉！不會玩猜數字的可以先去找猜數字怎麼玩
></details>
- [X] 回傳要猜測的數字：https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}&num=9000
>1A0B
- [X] 回傳要猜測的數字：https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}&num=9010
>2A0B
- [X] 回傳要猜測的數字：https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}&num=9013
>3A0B
- [X] https://lidemy-http-challenge.herokuapp.com/lv10?token={duZDsG3tvoA}&num=9613
>很開心在這裡的時光能有你一起陪伴，讓我的生活不再那麼一成不變，很開心認識你，下次有機會再一起玩吧！
- [X] 取得第11關 token：
>The End，恭喜破關！
>
>author: huli@lidemy.com  
>https://www.facebook.com/lidemytw/
>
>附註：
>原本遊戲只規劃到這邊，第十關就是最後一關。  
>後來我有加了一些新關卡但難度較高，如果你還想挑戰看看，下一關的 token 為 {IhateCORS}

***

- [X] 前進第11關：https://lidemy-http-challenge.herokuapp.com/lv11?token={IhateCORS}
- [X] 第11關關卡介紹：
>嘿！很開心看到你願意回來繼續幫忙，這次我們接到一個新的任務，要跟在菲律賓的一個中文圖書館資訊系統做串連  
>這邊是他們的 API 文件，你之後一定會用到：https://gist.github.com/aszx87410/0b0d3cabf32c4e44084fadf5180d0cf4  
>
>現在就讓我們先跟他們打個招呼吧，只是我記得他們的 API 好像會限制一些東西就是了...  
>
><details>
>  <summary>提示1</summary>
>  伺服器會檢查 origin 這個 header，只要騙過伺服器就行了
></details>
- [X] 查閱[跨國圖書館資訊系統 API 文件 v3](https://gist.github.com/aszx87410/0b0d3cabf32c4e44084fadf5180d0cf4)，打招呼方法
- [X] 發送 https://lidemy-http-challenge.herokuapp.com/api/v3/hello
>您的 origin 不被允許存取此資源，請確認您是從 lidemy.com 送出 request。
- [X] 增加 Origin，發送 https://lidemy-http-challenge.herokuapp.com/api/v3/hello

``` js
const request = require('request');

request.get({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v3/hello',
  headers: {
    Origin: 'lidemy.com',
  },
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

- [X] 取得第12關 token：
>Hello! 下一關的 token 為 {r3d1r3c7}

***

- [X] 前進第12關：https://lidemy-http-challenge.herokuapp.com/lv12?token={r3d1r3c7}
- [X] 第12關關卡介紹：
>打完招呼之後我們要開始送一些書過去了，不過其實運送沒有你想像中的簡單，不是單純的 A 到 B 而已  
>而是像轉機那樣，A 到 C，C 才到 B，中間會經過一些轉運點才會到達目的地...算了，我跟你說那麼多幹嘛  
>
>現在請你幫我把運送要用的 token 給拿回來吧，要有這個 token 我們才能繼續往下一步走
>
><details>
>  <summary>提示1</summary>
> 
>  你會發現你呼叫 API 以後它並沒有直接回傳結果，而是轉址到其他地方（或許中間還經歷不只一個地方）
>
>  仔細研究這些地方吧！
></details>
- [X] 查閱[跨國圖書館資訊系統 API 文件 v3](https://gist.github.com/aszx87410/0b0d3cabf32c4e44084fadf5180d0cf4)，獲取運送 token 方法
- [X] 發送 https://lidemy-http-challenge.herokuapp.com/api/v3/deliver_token
>我已經把運送要用的 token 給你囉，請你仔細找找
- [X] 取得第13關 token：
>回應網頁按右鍵檢查 > Networks > stopover > Status Code: 302 > Response Headers > view source > X-Lv13-Token: {qspyz}

***

- [X] 前進第13關：https://lidemy-http-challenge.herokuapp.com/lv13?token={qspyz}
- [X] 第13關關卡介紹：
>太好了！自從你上次把運送用的 token 拿回來以後，我們就密切地與菲律賓在交換書籍  
>可是最近碰到了一些小問題，不知道為什麼有時候會傳送失敗  
>我跟他們反映過後，他們叫我們自己去拿 log 來看，你可以幫我去看看嗎？  
>從系統日誌裡面應該可以找到一些端倪  
>
><details>
>  <summary>提示1</summary>
>  你有聽過代理伺服器 proxy 嗎？
></details>
- [X] 查閱[跨國圖書館資訊系統 API 文件 v3](https://gist.github.com/aszx87410/0b0d3cabf32c4e44084fadf5180d0cf4)，獲取系統日誌方法
- [X] 發送 https://lidemy-http-challenge.herokuapp.com/api/v3/logs
>此 request 不是來自菲律賓，禁止存取系統資訊。
- [X] 搜尋菲律賓代理伺服器列表，逐一套用直到通過：
Chrome > Settings > Advanced > System > Open your computer's proxy settings > Proxies > Secure Web Proxy(HTTPS) > 121.58.246.247：8080
- [X] 取得第14關 token：
>[
> { logType: 'token', value: '{SEOisHard}' }
>]

***

- [X] 前進第14關：https://lidemy-http-challenge.herokuapp.com/lv14?token={SEOisHard}
- [X] 第14關關卡介紹：
>跟那邊的溝通差不多都搞定了，真是太謝謝你了，關於這方面沒什麼問題了！  
>不過我老大昨天給了我一個任務，他希望我去研究那邊的首頁內容到底是怎麼做的  
>為什麼用 Google 一搜尋關鍵字就可以排在第一頁，真是太不合理了  
>
>他們的網站明明就什麼都沒有，怎麼會排在那麼前面？  
>難道說他們偷偷動了一些手腳？讓 Google 搜尋引擎看到的內容跟我們看到的不一樣？  
>
>算了，還是不要瞎猜好了，你幫我們研究一下吧！  
>
><details>
>  <summary>提示1</summary>
>  伺服器是怎麼辨識是不是 Google 搜尋引擎的？仔細想想之前我們怎麼偽裝自己是 IE6 的
></details>
- [X] 查閱[跨國圖書館資訊系統 API 文件 v3](https://gist.github.com/aszx87410/0b0d3cabf32c4e44084fadf5180d0cf4)，獲取首頁內容方法
- [X] 搜尋各個搜索引擎的 User-Agent，找到 Google 增加 User-Agent 後發送請求：

``` js
const request = require('request');

request.get({
  url: 'https://lidemy-http-challenge.herokuapp.com/api/v3/index',
  headers: {
    'User-Agent': 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
  },
},
  (error, httpResponse, body) => {
    console.log(body);
  },
);
```

- [X] 取得第15關 token：

``` html
<html>
  <h1>I Love Google</h1>
  <p>Google please rank our website higher, PLEASE!</p>
  <!-- token for lv15：{ILOVELIdemy!!!}  -->
</html>
```

***

- [X] 前進第15關：https://lidemy-http-challenge.herokuapp.com/lv15?token={ILOVELIdemy!!!}
- [X] 破關成功：
>還真的是我猜的那樣...不過還是要謝謝你幫我們完成這麼多任務！  
>今天是我在這職位的最後一天啦，之後我要升官了，應該就不用處理這麼多小事情了  
>這段期間感謝你的幫忙，我們以後有緣再相見啦！  
>
>The End，恭喜破關！  
>這次是真的破關了，這是最後一關，感謝你願意參與這個遊戲  
>也希望這遊戲是有趣的，希望你在玩的時候有學到東西  
>也歡迎把這個遊戲分享給親朋好友們  
>感謝！  
>
>我開了一個 gist，大家可以在這邊隨意留言，或是講一下破關感言  
>https://gist.github.com/aszx87410/1dbde92876ba253a45654988ca829ebb  
>
>最後，感謝所有幫我測試的朋友們  
>
>Author: huli@lidemy.com  
>https://www.facebook.com/lidemytw/