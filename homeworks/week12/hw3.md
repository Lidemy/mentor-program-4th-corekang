## 請簡單解釋什麼是 Single Page Application
單頁應用程式（Single Page Application, SPA）以提升使用者體驗為目標，不必跳轉頁面、透過單一頁面完成 CRUD。原本 Server-side Response 包含讀取資料、渲染完整網頁，SPA 模式透過 AJAX 改為 Server-side 提供資料，Client-side 以 JavaScript 動態新增網頁內容至單一頁面，除了首次瀏覽維持 SSR 渲染載入 HTML、CSS、JavaScript 檔案，之後只須更新部分資料，執行 Request 不須跳轉頁面，接收 Response 也不須重新載入整個網頁。


## SPA 的優缺點為何
SPA 優點：實現網頁部分更新，提升使用者體驗，減少 Server Response 渲染網頁負載量。
SPA 缺點：由於前端輸出單一頁面，JavaScript 動態新增網頁內容，原始碼實際上沒有內容，只有基本架構，因此 SEO 效能不好，除了 Google crawlers 支援前端渲染，不過其他瀏覽器支援度不好，首次瀏覽可改為 SSR 先載入網頁內容，之後維持 SPA 更新部分網頁內容，此外還有預渲染、靜態化等改善方法，也各有優缺點。原本由後端處理的狀態管理、路由，必須改由前端判斷，必須負責狀態管理、路由，前端管理更為複雜。（不確定工作複雜度算不算缺點）


## 這週這種後端負責提供只輸出資料的 API，前端一律都用 Ajax 串接的寫法，跟之前透過 PHP 直接輸出內容的留言板有什麼不同？
後端 API 輸出純資料，前端解析資料結構，於瀏覽器動態新增內容並渲染網頁，因此只需要 .html；瀏覽器按滑鼠右鍵檢視原始碼，因此未見任何留言。
PHP 直接輸出內容，由後端處理渲染網頁內容，回傳前端瀏覽器顯示；瀏覽器按滑鼠檢視原始碼，因此可見全部留言。

參考資料
- [單一頁面應用程式](https://medium.com/@mybaseball52/單一頁面應用程式-c98c8a17081)
- [跟著小明一起搞懂技術名詞：MVC、SPA 與 SSR](https://medium.com/@hulitw/introduction-mvc-spa-and-ssr-545c941669e9)
- [单页应用SPA做SEO的一种清奇的方案](https://juejin.im/post/6844903764055293966)