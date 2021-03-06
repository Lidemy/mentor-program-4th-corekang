## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
- 加密：需要密鑰，可以解密得到明文，雙向可逆，主要應用於資料傳遞安全性。
- 雜湊：不需要密鑰，無法解密得到明文，單向不可逆，主要應用於驗證資料完整性。

使用者可能普遍使用相同帳號、密碼登入常用網站，因此任何人、任何方法都不能直接存取密碼明文或逆向解密密碼，加強資訊安全。避免駭客竊取資料庫，導致個人資料外洩，進而嘗試登入使用者常用網站，以獲取其他網站機密資料。

## `include`、`require`、`include_once`、`require_once` 的差別
- include()：告知 PHP 提取指定檔案，並匯入、執行其全部內容，適合匯入動態內容。每次使用皆重新提取，即使檔案已匯入。找不到檔案時，僅觸發 Warning，不對執行程式產生任何影響，除非程式含有重大錯誤。
- include_once()：提取檔案前檢查是否已匯入，若已匯入則忽略，其他相同於 include()。
- require()：告知 PHP 必須提取指定檔案，並匯入其全部內容，進而執行程式，適合匯入靜態內容。找不到檔案時，觸發 Fatal Error，進而停止執行程式，不同於 include()、include_once() 無法提取檔案時仍舊執行程式的問題。
- require_once()：提取必需檔案前檢查是否已匯入，若已匯入則忽略，其他相同於 require()。


## 請說明 SQL Injection 的攻擊原理以及防範方法
SQL Injection 藉由輸入字串改變 SQL Query 邏輯，夾帶惡意指令，入侵資料庫伺服器。透過 MySQL 內建機制 Prepared Statements 跳脫字元，將指令解釋為字串；並設定資料庫帳號權限，不須更新資料庫的場合僅提供 SQL View，減少入侵風險；顯示錯誤資訊避免包含 SQL 相關資訊。


##  請說明 XSS 的攻擊原理以及防範方法
XSS 透過他人網站置入惡意程式碼，當使用者瀏覽網站，將執行惡意程式碼，例如導向釣魚網站。應將所有輸入內容經過特殊處理再顯示，可透過 PHP 內建函式 htmlspecialchars() 編碼特殊字元。

## 請說明 CSRF 的攻擊原理以及防範方法
CSRF 攻擊成立必要條件為使用者保持某網站登入狀態，在使用者不知情狀況下發送請求給特定網域，以取得儲存使用者登入資訊的 Cookie，進而冒充身分傳達非預期指令。例如誘導使用者點選圖片連結 `<a href='https://XXX.XXX/delete?articleId=XXX'>明年運勢預測</a>`，即能不知不覺刪除某篇文章，同理也能「被轉帳」至駭客帳戶。使用者應避免使用自動登入，當停止瀏覽網站一段時間自動登出，降低 CSRF 攻擊機會。前端應檢查 Request Headers Referer，確認來源非跨站請求，然而某些軟體、瀏覽器可停用 Referer，檢查規則仍有漏洞。同時加入權杖同步模式（STP）驗證 Token，由伺服器端產生提供 Token，加密儲存於 Session，因此無法偽造，並且定時更新，這是唯一能確認是否由使用者親自發送請求的方法，如果未夾帶 Token 則不予理會，以此防範 CSRF。