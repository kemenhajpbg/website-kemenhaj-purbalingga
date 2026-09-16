// Kemenhaj Purbalingga Consultation Chatbot

document.addEventListener('DOMContentLoaded', () => {
    // 1. Check if the chatbot widget is already injected
    if (document.getElementById('kemenhaj-chatbot-container')) return;

    // Get dynamic waiting period from meta tag
    const metaWait = document.querySelector('meta[name="hajj-waiting-period"]');
    const waitingPeriodVal = metaWait ? metaWait.getAttribute('content') : "29 Tahun";

    // 2. Define QA responses
    const responses = {
        daftar: {
            text: "**Persyaratan Daftar Haji Reguler**\nCalon jemaah harus:\n- **Beragama Islam**\n- **Berusia minimal 12 tahun** saat mendaftar\n- **Memiliki KTP** sesuai domisili\n- **Memiliki Kartu Keluarga (KK)**\n- **Memiliki salah satu dokumen identitas pendukung:**\n  - Akta kelahiran, atau\n  - Surat kenal lahir, atau\n  - Kutipan akta nikah, atau\n  - Ijazah\n- **Memiliki tabungan haji atas nama sendiri** di Bank Penerima Setoran Biaya Penyelenggaraan Ibadah Haji (BPS-BPIH).\n\n**Alur Pendaftaran Haji Reguler:**\na. Buka tabungan haji di bank penerima setoran haji (BPS-BPIH).\nb. Setor dana awal haji dan dapatkan bukti setoran.\nc. Datang ke Kantor Kementerian Haji dan Umrah (Kemenhaj) kabupaten/kota dengan membawa dokumen persyaratan.\nd. Verifikasi dokumen dan perekaman data oleh petugas Kemenhaj.\ne. Foto secara langsung di kantor Kemenhaj dengan busana sopan serta tidak menggunakan seragam dinas atau pakaian berwarna putih.\nf. Mendapat nomor porsi haji sebagai bukti resmi pendaftaran dan dasar antrean keberangkatan.",
            options: ["Pelimpahan Porsi", "Pembatalan Haji", "Cek Masa Tunggu", "Menu Utama"]
        },
        pelimpahan: {
            text: "Pelimpahan nomor porsi haji dapat dilakukan karena jemaah meninggal dunia atau mengalami sakit permanen. Silakan pilih kategori pelimpahan di bawah ini:",
            options: ["Pelimpahan (Meninggal)", "Pelimpahan (Sakit)", "Menu Utama"]
        },
        pelimpahan_meninggal: {
            text: "**Persyaratan Pelimpahan Nomor Porsi Haji karena Meninggal Dunia:**\na. Surat permohonan pelimpahan kepada Kepala Kemenhaj Kabupaten/Kota.\nb. Akta kematian.\nc. Bukti setoran awal dan/atau pelunasan BIPIH.\nd. Surat kuasa penunjukan penerima pelimpahan dari ahli waris.\ne. Surat Keterangan Tanggung Jawab Mutlak (SKTJM).\nf. KTP, KK, akta kelahiran/akta nikah atau dokumen yang membuktikan hubungan keluarga.",
            options: ["Pelimpahan (Sakit)", "Pendaftaran Haji", "Menu Utama"]
        },
        pelimpahan_sakit: {
            text: "**Persyaratan Pelimpahan Nomor Porsi Haji karena Sakit Permanen:**\na. Surat permohonan pelimpahan kepada Kepala Kemenhaj Kabupaten/Kota.\nb. Surat keterangan dokter yang menyatakan sakit permanen.\nc. Bukti setoran awal dan/atau pelunasan BIPIH.\nd. Surat kuasa penunjukan penerima pelimpahan.\ne. Surat Keterangan Tanggung Jawab Mutlak (SKTJM).\nf. KTP, KK, akta kelahiran/akta nikah atau dokumen pendukung hubungan keluarga.",
            options: ["Pelimpahan (Meninggal)", "Pendaftaran Haji", "Menu Utama"]
        },
        batal: {
            text: "Pembatalan porsi haji reguler dapat diajukan jika jemaah meninggal dunia (tanpa pelimpahan) atau karena alasan mendesak lainnya.\n\n**Persyaratan Pembatalan:**\n1. Surat permohonan pembatalan jemaah/ahli waris\n2. Bukti Setoran Awal BPIH (asli)\n3. Fotokopi KTP jemaah (dan KTP ahli waris jika meninggal)\n4. Fotokopi Buku Tabungan jemaah/ahli waris yang masih aktif (untuk pengembalian dana)\n5. Surat Kematian dari instansi berwenang (jika meninggal).\n\nDana BPIH akan ditransfer langsung ke rekening yang dilampirkan setelah proses administrasi selesai.",
            options: ["Pendaftaran Haji", "Pelimpahan Porsi", "Menu Utama"]
        },
        tunggu: {
            text: `Masa tunggu (estimasi keberangkatan) jemaah haji Kabupaten Purbalingga saat ini berkisar antara **${waitingPeriodVal}** tergantung kuota dan urutan antrean.\n\nAnda dapat memeriksa langsung estimasi keberangkatan Anda dengan klik tombol **'Cek Estimasi Keberangkatan'** di halaman utama website ini dan memasukkan **Nomor Porsi Haji** (10 digit) Anda.`,
            options: ["Pendaftaran Haji", "Hubungi Petugas", "Menu Utama"]
        },
        satuhaji: {
            text: "Aplikasi **SatuHaji** adalah aplikasi mobile resmi yang disediakan oleh Kementerian Agama RI untuk memberikan kemudahan bagi jemaah dalam memantau porsi keberangkatan, informasi manasik haji, pendaftaran digital, dan panduan perjalanan haji/umrah.\n\nAnda dapat mengunduhnya secara gratis di Google Play Store dengan mengeklik tombol unduh di bagian atas beranda website ini.",
            options: ["Pendaftaran Haji", "Cek Masa Tunggu", "Menu Utama"]
        },
        petugas: {
            text: "Layanan konsultasi tatap muka dibuka setiap hari kerja:\n- **Senin - Kamis:** 08:00 - 15:00 WIB\n- **Jumat:** 08:00 - 15:30 WIB\nAtau Anda dapat menghubungi langsung petugas konsultasi kami melalui WhatsApp di nomor resmi **0822-2502-0837**.",
            options: ["Kirim Pesan WA", "Menu Utama"]
        },
        default: {
            text: "Maaf, kami tidak mengenali pertanyaan Anda. Silakan pilih salah satu menu konsultasi cepat berikut ini atau hubungi langsung petugas kami melalui WhatsApp.",
            options: ["Pendaftaran Haji", "Pelimpahan Porsi", "Pembatalan Haji", "Cek Masa Tunggu", "Info Aplikasi SatuHaji", "Hubungi Petugas"]
        }
    };

    // 3. Inject Chatbot HTML Markup
    const chatbotHTML = `
        <!-- Floating Action Button -->
        <button id="kemenhaj-chatbot-fab" class="chatbot-fab" title="Konsultasi Online Kemenhaj">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 0 1-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" />
            </svg>
            <span class="fab-tooltip">Konsultasi Haji</span>
        </button>

        <!-- Chat Window -->
        <div id="kemenhaj-chatbot-window" class="chatbot-window is-hidden">
            <!-- Header -->
            <div class="chat-header">
                <div class="chat-avatar">
                    <img src="/images/logo-kemenhaj.png" alt="Logo Kemenhaj" onerror="this.src='https://haji.go.id/sites/default/files/logo-kemenag.png';">
                </div>
                <div class="chat-header-info">
                    <h4>Kemenhaj Purbalingga</h4>
                    <span class="chat-status"><span class="status-dot"></span>Asisten Virtual Online</span>
                </div>
                <button id="kemenhaj-chatbot-close" class="chat-close-btn" title="Tutup Chat">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Messages Logs -->
            <div id="kemenhaj-chat-messages" class="chat-messages">
                <!-- Messages will be dynamically rendered here -->
            </div>

            <!-- Typing Indicator (Hidden by default) -->
            <div id="kemenhaj-chat-typing" class="chat-typing-indicator is-hidden">
                <div class="typing-bubble">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>

            <!-- Quick Reply Options Container -->
            <div id="kemenhaj-chat-options" class="chat-options"></div>

            <!-- Input Area -->
            <div class="chat-input-area">
                <input type="text" id="kemenhaj-chat-input" placeholder="Ketik pertanyaan Anda..." autocomplete="off">
                <button id="kemenhaj-chat-send" class="chat-send-btn" title="Kirim">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </div>
        </div>
    `;

    const chatbotContainer = document.createElement('div');
    chatbotContainer.id = 'kemenhaj-chatbot-container';
    chatbotContainer.innerHTML = chatbotHTML;
    document.body.appendChild(chatbotContainer);

    // 4. Cache DOM elements
    const fab = document.getElementById('kemenhaj-chatbot-fab');
    const win = document.getElementById('kemenhaj-chatbot-window');
    const closeBtn = document.getElementById('kemenhaj-chatbot-close');
    const messagesContainer = document.getElementById('kemenhaj-chat-messages');
    const typingIndicator = document.getElementById('kemenhaj-chat-typing');
    const optionsContainer = document.getElementById('kemenhaj-chat-options');
    const inputField = document.getElementById('kemenhaj-chat-input');
    const sendBtn = document.getElementById('kemenhaj-chat-send');

    let isInitialized = false;

    // 5. Open / Close Widget
    const openChat = () => {
        win.classList.remove('is-hidden');
        fab.classList.add('is-hidden');
        inputField.focus();

        if (!isInitialized) {
            isInitialized = true;
            showWelcomeMessage();
        }
    };

    const closeChat = () => {
        win.classList.add('is-hidden');
        fab.classList.remove('is-hidden');
    };

    fab.addEventListener('click', openChat);
    closeBtn.addEventListener('click', closeChat);

    // Intercept clicks on the "Konsultasi" service card on the homepage
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        const title = card.querySelector('h4');
        if (title && title.textContent.trim().toLowerCase() === 'konsultasi') {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                openChat();
            });
        }
    });

    // 6. Message Rendering Helpers
    const scrollToBottom = () => {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    };

    const showTyping = () => {
        typingIndicator.classList.remove('is-hidden');
        scrollToBottom();
    };

    const hideTyping = () => {
        typingIndicator.classList.add('is-hidden');
    };

    const formatMessageText = (text) => {
        // Simple Markdown-to-HTML parser (handles bold text and line breaks)
        return text
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    };

    const addMessage = (sender, text) => {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${sender === 'user' ? 'user-msg' : 'bot-msg'}`;

        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        contentDiv.innerHTML = formatMessageText(text);

        messageDiv.appendChild(contentDiv);
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    };

    const renderOptions = (options) => {
        optionsContainer.innerHTML = '';
        if (!options || options.length === 0) return;

        options.forEach(opt => {
            const btn = document.createElement('button');
            btn.className = 'chat-option-btn';
            btn.textContent = opt;
            btn.addEventListener('click', () => handleOptionClick(opt));
            optionsContainer.appendChild(btn);
        });
        scrollToBottom();
    };

    // 7. Conversation Logic Handler
    const showWelcomeMessage = () => {
        showTyping();
        setTimeout(() => {
            hideTyping();
            addMessage('bot', "Selamat datang di Layanan Konsultasi Digital Kantor Kementerian Haji dan Umrah Purbalingga. 😊\n\nAda yang bisa kami bantu hari ini? Silakan pilih opsi di bawah ini atau ketik langsung pertanyaan Anda.");
            renderOptions(["Pendaftaran Haji", "Pelimpahan Porsi", "Pembatalan Haji", "Cek Masa Tunggu", "Info Aplikasi SatuHaji", "Hubungi Petugas"]);
        }, 1200);
    };

    const handleOptionClick = (option) => {
        // Add user selection
        addMessage('user', option);
        optionsContainer.innerHTML = '';

        if (option === "Kirim Pesan WA") {
            window.open("https://wa.me/6282225020837?text=Halo%20petugas%20layanan%20haji%20Kemenag%20Purbalingga,%20saya%20ingin%20konsultasi...", "_blank");
            setTimeout(() => {
                showTyping();
                setTimeout(() => {
                    hideTyping();
                    addMessage('bot', "Silakan lanjutkan percakapan Anda dengan petugas kami di WhatsApp. Apakah ada hal lain yang bisa kami bantu di sini?");
                    renderOptions(["Menu Utama"]);
                }, 800);
            }, 500);
            return;
        }

        let key = '';
        if (option === "Pendaftaran Haji") key = 'daftar';
        else if (option === "Pelimpahan Porsi") key = 'pelimpahan';
        else if (option === "Pelimpahan (Meninggal)") key = 'pelimpahan_meninggal';
        else if (option === "Pelimpahan (Sakit)") key = 'pelimpahan_sakit';
        else if (option === "Pembatalan Haji") key = 'batal';
        else if (option === "Cek Masa Tunggu") key = 'tunggu';
        else if (option === "Info Aplikasi SatuHaji") key = 'satuhaji';
        else if (option === "Hubungi Petugas") key = 'petugas';
        else if (option === "Menu Utama") {
            showWelcomeMessage();
            return;
        }

        showTyping();
        setTimeout(() => {
            hideTyping();
            const resp = responses[key] || responses.default;
            addMessage('bot', resp.text);
            renderOptions(resp.options);
        }, 1000);
    };

    const processTextInput = () => {
        const query = inputField.value.trim();
        if (!query) return;

        addMessage('user', query);
        inputField.value = '';
        optionsContainer.innerHTML = '';

        showTyping();

        setTimeout(() => {
            hideTyping();
            const lowerQuery = query.toLowerCase();
            let matchedKey = 'default';

            if (lowerQuery.match(/(daftar|syarat|biaya|cara|proses|registrasi|kemenag)/)) {
                matchedKey = 'daftar';
            } else if (lowerQuery.match(/(sakit)/)) {
                matchedKey = 'pelimpahan_sakit';
            } else if (lowerQuery.match(/(meninggal|wafat|mati|kematian|waris)/)) {
                matchedKey = 'pelimpahan_meninggal';
            } else if (lowerQuery.match(/(pelimpahan|kuota|porsi)/)) {
                matchedKey = 'pelimpahan';
            } else if (lowerQuery.match(/(batal|refund|tarik)/)) {
                matchedKey = 'batal';
            } else if (lowerQuery.match(/(tunggu|antri|estimasi|tahun|berangkat|cek)/)) {
                matchedKey = 'tunggu';
            } else if (lowerQuery.match(/(aplikasi|satuhaji|satu haji|playstore|play store|download|unduh)/)) {
                matchedKey = 'satuhaji';
            } else if (lowerQuery.match(/(kontak|whatsapp|wa|nomor|telepon|petugas|cs|admin)/)) {
                matchedKey = 'petugas';
            }

            const resp = responses[matchedKey];
            addMessage('bot', resp.text);
            renderOptions(resp.options);
        }, 1200);
    };

    // Keyboard and Send listeners
    sendBtn.addEventListener('click', processTextInput);
    inputField.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            processTextInput();
        }
    });
});