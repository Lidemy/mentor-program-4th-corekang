## 交作業流程

#### 前置作業
1. 點擊GitHub Classroom邀請網址。
2. 等待GitHub Classroom將[程式導師實驗計畫第四期課綱](https://github.com/Lidemy/mentor-program-4th)複製至個人GitHub帳號。（以下以GitHub帳號corekang為例）
3. 確認建立GitHub repository [Lidemy
/ mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)。
4. 前往[Lidemy
/ mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)，點擊`Clone or download`，複製`Clone with HTTPS`。
5. 回到CLI，`git clone ClonewithHTTPS`，將[Lidemy
/ mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)下載至本機。
6. `cd mentor-program-4th-corekang`切換為所在位置。
   
#### 寫作業（以下以第1週為例）
1. 每週寫作業前，`git branch week1`新增分支。
2. 完成作業，開啟`~/Documents/mentor-program-4th-corekang/homeworks/week1`。
3. `git checkout week1`切換為所在分支，`git status`確認檔案變動，`git commit -am "week1完成"`建立作業版本。

#### 交作業
1. 統一提交當週所有作業，挑戰題可另外提交。
2. `git push origin week1`，同步至[Lidemy / mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)。
3. 前往[Lidemy / mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)，點擊新提示`Your recently pushed branches: week1`，點擊`Compare & pull request`，確認修改內容後，點擊`Create pull request`。
4. 前往[Lidemy學習系統](https://learning.lidemy.com/) > 作業列表 > 新增作業 > 第幾週、PR連結 > 勾選「確認已經檢查過作業、有完成需求」、「確認已經看過當週的自我檢討並修正錯誤」 > 送出。

#### 改作業
1. 助教修改作業後，助教點擊`Merge pull request` > `Confirm merge` > `Delete branch`，確認合併且刪除分支。
2. 顯示紫色Merged，回到CLI，`git checkout master` > `git pull origin master`，同步[Lidemy / mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)。
3. `git branch -d week1` > `git branch -v`，刪除分支、確認只有master。
4. `git log`顯示Merge pull request #6 from Lidemy/week1、week1完成。

#### 同步主課綱
1. 確認[程式導師實驗計畫第四期課綱](https://github.com/Lidemy/mentor-program-4th)更新內容。
2. 狀況1：處於寫作業狀態，建立作業版本`git commit -am "week1完成"`，依步驟4同步課綱。
3. 狀況2：本機沒有新版本狀態，`git checkout master` > `git status`，顯示`nothing to commit`，依步驟4同步課綱。。
4. 複製[程式導師實驗計畫第四期課綱](https://github.com/Lidemy/mentor-program-4th)Clone with HTTPS。
5. 回到CLI，`git pull ClonewithHTTPS網址 master`同步課綱，出現Vim編輯器，輸入`:wq enter`離開，顯示README.md更新。
6. `git push origin master`，同步課綱至[Lidemy
/ mentor-program-4th-corekang](https://github.com/Lidemy/mentor-program-4th-corekang)。