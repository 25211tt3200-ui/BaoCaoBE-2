(function () {
  const API = 'api/chat.php';
  const sid = localStorage.getItem('aiw_sid') ||
    (crypto.randomUUID ? crypto.randomUUID() : String(Date.now()));
  localStorage.setItem('aiw_sid', sid);

  document.body.insertAdjacentHTML('beforeend', `
    <button id="aiw-btn" aria-label="Mở trợ lý AI">💬</button>
    <div id="aiw-box" role="dialog" aria-label="Trợ lý AI">
      <div class="aiw-head"><span>Trợ lý AI nội bộ</span><button id="aiw-x">✕</button></div>
      <div id="aiw-msgs"></div>
      <form class="aiw-form" id="aiw-form">
        <input id="aiw-in" placeholder="Hỏi về dữ liệu nội bộ..." maxlength="500" autocomplete="off">
        <button type="submit">Gửi</button>
      </form>
    </div>`);

  const $ = id => document.getElementById(id);
  const box = $('aiw-box'), msgs = $('aiw-msgs'), input = $('aiw-in'),
        form = $('aiw-form'), sendBtn = form.querySelector('button');

  function add(text, cls) {
    const d = document.createElement('div');
    d.className = 'aiw-m ' + cls;
    d.textContent = text;           // textContent: chống XSS
    msgs.appendChild(d);
    msgs.scrollTop = msgs.scrollHeight;
    return d;
  }

  async function loadHistory() {
    try {
      const r = await fetch('api/history.php?session_id=' + encodeURIComponent(sid));
      (await r.json()).forEach(h => { add(h.question, 'aiw-user'); add(h.answer, 'aiw-bot'); });
    } catch (e) {}
    if (!msgs.children.length) add('Xin chào! Bạn muốn tìm thông tin nội bộ nào?', 'aiw-bot');
  }

  $('aiw-btn').onclick = () => { box.classList.toggle('open'); input.focus(); };
  $('aiw-x').onclick = () => box.classList.remove('open');

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const q = input.value.trim();
    if (!q) return;
    input.value = ''; sendBtn.disabled = true;
    add(q, 'aiw-user');
    const typing = add('Đang tìm kiếm...', 'aiw-bot');
    try {
      const r = await fetch(API, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ question: q, session_id: sid })
      });
      const data = await r.json();
      if (!r.ok) throw new Error(data.error || 'Có lỗi xảy ra');
      typing.textContent = data.answer;
      if (data.sources && data.sources.length) {
        const s = document.createElement('div');
        s.className = 'aiw-src';
        s.textContent = 'Nguồn: ' + data.sources.map(x => x.title).join(' • ');
        msgs.appendChild(s);
      }
    } catch (err) {
      typing.textContent = err.message;
      typing.classList.add('aiw-err');
    } finally {
      sendBtn.disabled = false; input.focus();
      msgs.scrollTop = msgs.scrollHeight;
    }
  });

  loadHistory();
})();
