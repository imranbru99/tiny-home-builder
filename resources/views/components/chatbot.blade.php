<div id="brand-chat" class="fixed bottom-24 right-5 z-50 w-[min(100vw-2rem,22rem)]">
    <button type="button" id="brand-chat-toggle"
            class="ml-auto mb-2 block rounded-full bg-glacier px-4 py-2 text-sm font-semibold text-white shadow-lg">
        Ask Nestline AI
    </button>
    <div id="brand-chat-panel" class="hidden overflow-hidden rounded-2xl border border-alpine/10 bg-white shadow-2xl">
        <div class="bg-alpine px-4 py-3 text-sm font-semibold text-white">Nestline tiny-home assistant</div>
        <div id="brand-chat-log" class="h-64 space-y-2 overflow-y-auto bg-frost p-3 text-sm"></div>
        <form id="brand-chat-form" class="flex gap-2 border-t border-alpine/10 p-3">
            <input id="brand-chat-input" type="text" placeholder="Ask about models, haul, cost, timeline..."
                   class="flex-1 rounded-lg border border-alpine/15 px-3 py-2 text-sm outline-none focus:border-glacier" required>
            <button class="rounded-lg bg-glacier px-3 py-2 text-sm font-semibold text-white">Send</button>
        </form>
    </div>
</div>
<script>
(() => {
    const toggle = document.getElementById('brand-chat-toggle');
    const panel = document.getElementById('brand-chat-panel');
    const form = document.getElementById('brand-chat-form');
    const input = document.getElementById('brand-chat-input');
    const log = document.getElementById('brand-chat-log');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const add = (who, text) => {
        const row = document.createElement('div');
        row.className = who === 'you' ? 'text-right' : '';
        row.innerHTML = `<span class="inline-block max-w-[90%] rounded-xl px-3 py-2 ${who === 'you' ? 'bg-glacier text-white' : 'bg-white border border-alpine/10 text-ink'}">${text}</span>`;
        log.appendChild(row);
        log.scrollTop = log.scrollHeight;
    };

    toggle.addEventListener('click', () => panel.classList.toggle('hidden'));
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        add('you', message);
        input.value = '';
        try {
            const res = await fetch('{{ route('ai.chat') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message }),
            });
            const data = await res.json();
            add('bot', data.reply || 'Sorry, try again.');
        } catch {
            add('bot', 'Connection issue. Please call (512) 555-0142.');
        }
    });
})();
</script>
