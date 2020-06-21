## 請解釋後端與前端的差異。
1. 前端負責可見部分，HTML、CSS、JavaScript為三大架構，分別負責網頁內容結構、網頁視覺格式、網頁行為互動及資料串接。
2. 後端負責不可見部分，透過伺服器接收前端請求資料、回傳前端查詢資料，包含資料庫管理、系統架構。

## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。

1. 瀏覽器詢問DNS Server：google.com在哪裡？
2. DNS Server：地址是10.1.1.1。
3. 瀏覽器提交Request至10.1.1.1：我要存取這些資料。
4. Server @10.1.1.1接收Request。
5. Server詢問資料庫：請依關鍵字尋找資料。
6. 資料庫回傳資料給Server。
7. Server處理回傳Response給瀏覽器。
8. 瀏覽器解析回傳資訊並顯示。

## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用。

1. find path -name "filename"：關鍵字搜尋檔名，例如：`find . -name ".jpg"`搜尋電腦所有jpg檔案。
2. df -h：顯示硬碟容量使用狀況，包含檔案系統（Filesystem）、總容量（Size）、使用容量（Used）、可用容量（Avail）、使用率（Capacity）等等。
3. history：顯示最近執行指令。