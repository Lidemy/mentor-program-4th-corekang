## 跟你朋友介紹 Git

Git是版本控制程式，透過命令列介面輸入文字指令請電腦做事。為什麼使用Git？對於個人版本控制來說，最重要的是確認版本差別、變更順序。對於多人協作來說，可同時進行分工任務，再合併版本繼續開發。

Git五大基本功能：建立版本、特定檔案排除版本控制、版本編號使用不重複亂數、記錄最新版本、紀錄版本順序，其實這些都是常識觀念，弄清楚邏輯關係就很容易上手。資料夾也可達到類似管理功能，但不夠直覺，仰賴人力管理、判斷，而Git最重要的優點是管理檔案變動，這是資料夾難以清楚呈現的功能。

我以Mac iTerm2示範，iTerm2是命令列工具，另有內建命令列工具Terminal。以你的需求來看，依序列為以下步驟：

```
1. git --version   //安裝Git
2. git init        //git初始化
3. git add         //列入準版本
4. git commit      //建立版本
   git commit -am  //列入準版本+建立版本
5. git log         //檢視版本紀錄
```

`git add`就像是放入暫存資料夾，`git commit`才是正式建立版本。

`git diff`可確認建立版本前修改部分。若想確認其他版本內容，`git checkout 版本編號`，`git checkout master`再回到最新版本。

可能有些檔案並不須版本控制，有2個做法：
1. `git status`確認未版本控制檔案，`vim .gitignore`，第1行輸入檔名.檔案格式，`:wq`存檔離開。
2. `cat .gitignore 檔名.檔案格式`，直接忽略檔案。

如果你想以某個笑話為基礎，嘗試發展其他類型，但不想影響原本類型，`git branch`可另闢戰場。

主戰場分支固定稱為master，當你今天想投入新戰場時，`git checkout branch-name`記得切換戰場，如果不確定是否切換成功，`git branch -v`確認所在分支。

等新笑話類型開發成功，就可以將新戰場合併到主戰場，`git checkout master`回到主戰場後，`git merge new-feature`再將新戰場合併進來。

萬一版本衝突，Git會通知你手動修改後再通知它，通常`git status`確認重複修改檔案，點擊衝突檔案連結，決定保留內容，`git commit -am "版本說明"`再次建立版本。

你也可以加入GitHub，作為雲端空間同步備份你的笑話資料庫，未來也可以和朋友協作擴大開發，可以增加協作者、顯示他人建議、討論區、展示靜態網頁，其中最重要的功能是`Pull request`，合併前審核檔案變動。

GitHub等於是遠端，你是本地端，必須保持同步。簡單來說，透過`git pust origin master`將最新版本同步至遠端，透過`git pull origin master`下載遠端最新版本。