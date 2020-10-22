export const cssTemplate = '.card { margin-top: 12px; }';

// Step 9: Avoid repeating classname

// Generating code dynamically
export function getForm(className, commentsClassName) {
  return `
    <div>
      <form class="${className}">
        <div class="form-group">
          <label>暱稱</label>
          <input class="form-control" name="nickname" type="text">
          <label>留言內容</label>
          <textarea class="form-control" name="content" rows="3"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">提交</button>
      </form>
      <div class="${commentsClassName}">
      </div>
    </div>
  `; // form-add-comment => ${className}, comments => ${commentsClassName}, delete for & id
}

export function getLoadMoreButton(className) {
  return `<button class="${className} btn btn-primary">載入更多</button>`;
}
