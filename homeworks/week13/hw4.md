## Webpack 是做什麼用的？可以不用它嗎？
將各種檔案視為模組化資源，例如樣式、程式碼、影像，經過相關編譯套件轉換，最後透過 webpack 進行模組化整合，使不同瀏覽器能夠順利解析，支援非原生函式。因應前端工具越趨多元複雜，webpack 這類自動化管理工具有其必要性，預先定義設定檔，例如各種 module rules，自動搜尋設定檔進行打包所有相關模組。

先不論專案規模，webpack 應用有助於工作流程標準化，加強專案結構化設計，節省各種預處理器手動編譯時間，更清楚智慧管理解決方案的應用趨勢。有這些基本認知，依據不同專案規模、特質與需求，判斷是否必須借助 webpack，或是個別應用預處理器，比較容易正確評估有何差別。例如：目標是想依功能拆分檔案，使程式碼結構更簡潔，透過 webpack 整合支援模組依賴關係，使用 export/import、exports/require 機制，方便拆分檔案管理不同功能，需要再引入使用。如果目標結構較為單純，任務管理工具或許就足夠應付，設定管理部分也比較容易學習與操作。


## gulp 跟 webpack 有什麼不一樣？
gulp 是任務管理工具，對象是各種任務。webpack 是模組整合工具，對象是各種資源。兩者相似概念在於執行資源轉換（編譯），其他絕大部分功能無法彼此替代。比較兩者核心功能，gulp 在於定義與組織任務、基於文件流進行自動化建構、插件體系，webpack 在於根據模組依賴編譯目標文件、套件體系支持模組編譯、插件體系提供擴充功能。或從二者如何分工合作區別差異，例如 gulp 可以建立透過 webpack 執行的模組化任務，gulp 就是執行建構過程的工作流。


## CSS Selector 權重的計算方式為何？
權重越大，樣式越優先。依據 W3C 規範 [Calculating a selector's specificity](https://www.w3.org/TR/2018/REC-selectors-3-20181106/#specificity)，在同一個元素中，總計以下四類權重：（a）計算身分選擇器數量、（b）計算類別選擇器、屬性選擇器、偽類別選擇器數量、（c）計算型態選擇器、偽元素選擇器數量、（d）忽略通用選擇器。

權級由大而小為 a、b、c、d，其中通用選擇器不具權重；不過加上 !important、行內樣式，權級由大而小為 !important、行內樣式、a、b、c、d。!important 就像例外樣式宣告，一般不建議使用，源頭問題應該在於清楚權重計算。當權重相等，後寫樣式宣告覆蓋先前樣式宣告。

- 一般權重表示依序為（ID, class, element），例如 class selector（0, 1, 0）。
- 常見權重表示依序為（inline style, ID, class, element），例如 inline style（1, 0, 0, 0）。
- 例外權重表示依序為（!important, inline style, ID, class, element），例如 !important（1, 0, 0, 0, 0）。

