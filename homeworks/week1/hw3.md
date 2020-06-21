## 教你朋友 CLI

#### 什麼是Command Line？

有些電腦功能沒有提供操作選單、按鈕、介面等圖形使用者介面（GUI），就必須直接輸入文字指令，和電腦溝通需求，這個工具稱為命令列介面（CLI），通常是黑底白字，就像電影裡常見的駭客操作畫面。

你想要的功能很簡單，我用iTerm2示範操作，這是Mac的命令列工具（CLT），也有內建的Terminal，不過iTerm2可下載套件美化操作介面，長期為伍的話，iTerm2比較養眼。如果使用Windows，可用內建的命令提示字元，不過不同作業系統的指令不太一樣。

開啟iTerm2，顯示所在位置是家目錄，後續皆以所在位置為作業原點。想在家目錄下一層新增資料夾，輸入`mkdir wifi`，開啟家目錄就看見新增資料夾wifi，或是輸入`ls`顯示所在位置的所有檔案（不包含隱藏檔案）。

接著在資料夾wifi新增檔案，輸入`cd wifi`，前往資料夾wifi，代表切換所在位置。`cd`前往的是相對位置，例如後接子目錄名稱、回到上一層資料夾輸入`cd ..`、回到上上一層資料夾輸入`cd ...`。

所在位置是資料夾wifi，輸入`touch afu.js`，開啟資料夾wifi或輸入`ls`，就看見新增afu.js。

熟悉操作後，也會發現和電腦溝通的另一種樂趣，而且有時CLI效率更快更直覺。

#### CLI常用指令

Mac CLI常用指令分類整理如列。

```
   pwd                     //列印所在位置（Print Working Directory）
   ls                      //列印所有檔案（List Segment）
   ls -l                   //列印所有檔案詳細資訊（參數：-l）
   ls -al                  //列印所有檔案（包含隱藏檔案）（參數：-al）
   cd                      //切換資料夾（Change Directory）
   cd ..                   //回到上一層資料夾
   cd ~                    //回到家目錄（home目錄）
   cd /                    //前往根目錄（資料夾最底層）
   touch                   //碰一下檔案（變更修改時間為目前時間）
   touch                   //新增檔案（變數：不存在檔名）
   mkdir                   //新增資料夾（Make Directory）
   rm                      //刪除檔案（Remove）
   rmdir                   //刪除資料夾
   cp                      //複製檔案（Copy）（參數1：複製檔名、參數2：新檔名）
   mv                      //移動檔案（Move）（參數1：移動檔名、參數2：目標資料夾）
                           //重新命名（參數1：舊檔名、參數2：新檔名）
   man                     //使用說明（Manual），進入後按q離開           
```

```
   date                    //列印現在時間（Date）
   top                     //列印所有行程（Table Of Processes），進入後按q離開 
                           //編按：行程（process）意指正在執行的程式   
   cat                     //連接檔案（Catenate）、顯示檔案，進入後按q離開 
   less                    //分頁式印出檔案，進入後按q離開 
   grep                    //抓取特定關鍵字（參數1：關鍵字、參數2：檔名）
   echo                    //印出字串
   echo 'hi' > h.txt       //h.txt新增內容hi
```

```
   pipe |                  //串接（將前面輸出變成後面輸入）
   cat file.txt | grep hi  //例如：cat file.txt輸出123，grep hi輸入123
   redirect >              //重新導向
   echo hello > test.txt   //例如：將hello輸入至test.txt
```