document.addEventListener(`DOMContentLoaded`,()=>{if(document.getElementById(`kemenhaj-chatbot-container`))return;let e=document.querySelector(`meta[name="hajj-waiting-period"]`),t={daftar:{text:`**Persyaratan Daftar Haji Reguler**
Calon jemaah harus:
- **Beragama Islam**
- **Berusia minimal 12 tahun** saat mendaftar
- **Memiliki KTP** sesuai domisili
- **Memiliki Kartu Keluarga (KK)**
- **Memiliki salah satu dokumen identitas pendukung:**
  - Akta kelahiran, atau
  - Surat kenal lahir, atau
  - Kutipan akta nikah, atau
  - Ijazah
- **Memiliki tabungan haji atas nama sendiri** di Bank Penerima Setoran Biaya Penyelenggaraan Ibadah Haji (BPS-BPIH).

**Alur Pendaftaran Haji Reguler:**
a. Buka tabungan haji di bank penerima setoran haji (BPS-BPIH).
b. Setor dana awal haji dan dapatkan bukti setoran.
c. Datang ke Kantor Kementerian Haji dan Umrah (Kemenhaj) kabupaten/kota dengan membawa dokumen persyaratan.
d. Verifikasi dokumen dan perekaman data oleh petugas Kemenhaj.
e. Foto secara langsung di kantor Kemenhaj dengan busana sopan serta tidak menggunakan seragam dinas atau pakaian berwarna putih.
f. Mendapat nomor porsi haji sebagai bukti resmi pendaftaran dan dasar antrean keberangkatan.`,options:[`Pelimpahan Porsi`,`Pembatalan Haji`,`Cek Masa Tunggu`,`Menu Utama`]},pelimpahan:{text:`Pelimpahan nomor porsi haji dapat dilakukan karena jemaah meninggal dunia atau mengalami sakit permanen. Silakan pilih kategori pelimpahan di bawah ini:`,options:[`Pelimpahan (Meninggal)`,`Pelimpahan (Sakit)`,`Menu Utama`]},pelimpahan_meninggal:{text:`**Persyaratan Pelimpahan Nomor Porsi Haji karena Meninggal Dunia:**
a. Surat permohonan pelimpahan kepada Kepala Kemenhaj Kabupaten/Kota.
b. Akta kematian.
c. Bukti setoran awal dan/atau pelunasan BIPIH.
d. Surat kuasa penunjukan penerima pelimpahan dari ahli waris.
e. Surat Keterangan Tanggung Jawab Mutlak (SKTJM).
f. KTP, KK, akta kelahiran/akta nikah atau dokumen yang membuktikan hubungan keluarga.`,options:[`Pelimpahan (Sakit)`,`Pendaftaran Haji`,`Menu Utama`]},pelimpahan_sakit:{text:`**Persyaratan Pelimpahan Nomor Porsi Haji karena Sakit Permanen:**
a. Surat permohonan pelimpahan kepada Kepala Kemenhaj Kabupaten/Kota.
b. Surat keterangan dokter yang menyatakan sakit permanen.
c. Bukti setoran awal dan/atau pelunasan BIPIH.
d. Surat kuasa penunjukan penerima pelimpahan.
e. Surat Keterangan Tanggung Jawab Mutlak (SKTJM).
f. KTP, KK, akta kelahiran/akta nikah atau dokumen pendukung hubungan keluarga.`,options:[`Pelimpahan (Meninggal)`,`Pendaftaran Haji`,`Menu Utama`]},batal:{text:`Pembatalan porsi haji reguler dapat diajukan jika jemaah meninggal dunia (tanpa pelimpahan) atau karena alasan mendesak lainnya.

**Persyaratan Pembatalan:**
1. Surat permohonan pembatalan jemaah/ahli waris
2. Bukti Setoran Awal BPIH (asli)
3. Fotokopi KTP jemaah (dan KTP ahli waris jika meninggal)
4. Fotokopi Buku Tabungan jemaah/ahli waris yang masih aktif (untuk pengembalian dana)
5. Surat Kematian dari instansi berwenang (jika meninggal).

Dana BPIH akan ditransfer langsung ke rekening yang dilampirkan setelah proses administrasi selesai.`,options:[`Pendaftaran Haji`,`Pelimpahan Porsi`,`Menu Utama`]},tunggu:{text:`Masa tunggu (estimasi keberangkatan) jemaah haji Kabupaten Purbalingga saat ini berkisar antara **${e?e.getAttribute(`content`):`29 Tahun`}** tergantung kuota dan urutan antrean.\n\nAnda dapat memeriksa langsung estimasi keberangkatan Anda dengan klik tombol **'Cek Estimasi Keberangkatan'** di halaman utama website ini dan memasukkan **Nomor Porsi Haji** (10 digit) Anda.`,options:[`Pendaftaran Haji`,`Hubungi Petugas`,`Menu Utama`]},satuhaji:{text:`Aplikasi **SatuHaji** adalah aplikasi mobile resmi yang disediakan oleh Kementerian Agama RI untuk memberikan kemudahan bagi jemaah dalam memantau porsi keberangkatan, informasi manasik haji, pendaftaran digital, dan panduan perjalanan haji/umrah.

Anda dapat mengunduhnya secara gratis di Google Play Store dengan mengeklik tombol unduh di bagian atas beranda website ini.`,options:[`Pendaftaran Haji`,`Cek Masa Tunggu`,`Menu Utama`]},petugas:{text:`Layanan konsultasi tatap muka dibuka setiap hari kerja:
- **Senin - Kamis:** 08:00 - 15:00 WIB
- **Jumat:** 08:00 - 15:30 WIB
Atau Anda dapat menghubungi langsung petugas konsultasi kami melalui WhatsApp di nomor resmi **0822-2502-0837**.`,options:[`Kirim Pesan WA`,`Menu Utama`]},default:{text:`Maaf, kami tidak mengenali pertanyaan Anda. Silakan pilih salah satu menu konsultasi cepat berikut ini atau hubungi langsung petugas kami melalui WhatsApp.`,options:[`Pendaftaran Haji`,`Pelimpahan Porsi`,`Pembatalan Haji`,`Cek Masa Tunggu`,`Info Aplikasi SatuHaji`,`Hubungi Petugas`]}},n=document.createElement(`div`);n.id=`kemenhaj-chatbot-container`,n.innerHTML=`
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
    `,document.body.appendChild(n);let r=document.getElementById(`kemenhaj-chatbot-fab`),i=document.getElementById(`kemenhaj-chatbot-window`),a=document.getElementById(`kemenhaj-chatbot-close`),o=document.getElementById(`kemenhaj-chat-messages`),s=document.getElementById(`kemenhaj-chat-typing`),c=document.getElementById(`kemenhaj-chat-options`),l=document.getElementById(`kemenhaj-chat-input`),u=document.getElementById(`kemenhaj-chat-send`),d=!1,f=()=>{i.classList.remove(`is-hidden`),r.classList.add(`is-hidden`),l.focus(),d||(d=!0,y())};r.addEventListener(`click`,f),a.addEventListener(`click`,()=>{i.classList.add(`is-hidden`),r.classList.remove(`is-hidden`)}),document.querySelectorAll(`.service-card`).forEach(e=>{let t=e.querySelector(`h4`);t&&t.textContent.trim().toLowerCase()===`konsultasi`&&e.addEventListener(`click`,e=>{e.preventDefault(),f()})});let p=()=>{o.scrollTop=o.scrollHeight},m=()=>{s.classList.remove(`is-hidden`),p()},h=()=>{s.classList.add(`is-hidden`)},g=e=>e.replace(/\n/g,`<br>`).replace(/\*\*(.*?)\*\*/g,`<strong>$1</strong>`),_=(e,t)=>{let n=document.createElement(`div`);n.className=`chat-message ${e===`user`?`user-msg`:`bot-msg`}`;let r=document.createElement(`div`);r.className=`message-content`,r.innerHTML=g(t),n.appendChild(r),o.appendChild(n),p()},v=e=>{c.innerHTML=``,!(!e||e.length===0)&&(e.forEach(e=>{let t=document.createElement(`button`);t.className=`chat-option-btn`,t.textContent=e,t.addEventListener(`click`,()=>b(e)),c.appendChild(t)}),p())},y=()=>{m(),setTimeout(()=>{h(),_(`bot`,`Selamat datang di Layanan Konsultasi Digital Kantor Kementerian Haji dan Umrah Purbalingga. 😊

Ada yang bisa kami bantu hari ini? Silakan pilih opsi di bawah ini atau ketik langsung pertanyaan Anda.`),v([`Pendaftaran Haji`,`Pelimpahan Porsi`,`Pembatalan Haji`,`Cek Masa Tunggu`,`Info Aplikasi SatuHaji`,`Hubungi Petugas`])},1200)},b=e=>{if(_(`user`,e),c.innerHTML=``,e===`Kirim Pesan WA`){window.open(`https://wa.me/6282225020837?text=Halo%20petugas%20layanan%20haji%20Kemenag%20Purbalingga,%20saya%20ingin%20konsultasi...`,`_blank`),setTimeout(()=>{m(),setTimeout(()=>{h(),_(`bot`,`Silakan lanjutkan percakapan Anda dengan petugas kami di WhatsApp. Apakah ada hal lain yang bisa kami bantu di sini?`),v([`Menu Utama`])},800)},500);return}let n=``;if(e===`Pendaftaran Haji`)n=`daftar`;else if(e===`Pelimpahan Porsi`)n=`pelimpahan`;else if(e===`Pelimpahan (Meninggal)`)n=`pelimpahan_meninggal`;else if(e===`Pelimpahan (Sakit)`)n=`pelimpahan_sakit`;else if(e===`Pembatalan Haji`)n=`batal`;else if(e===`Cek Masa Tunggu`)n=`tunggu`;else if(e===`Info Aplikasi SatuHaji`)n=`satuhaji`;else if(e===`Hubungi Petugas`)n=`petugas`;else if(e===`Menu Utama`){y();return}m(),setTimeout(()=>{h();let e=t[n]||t.default;_(`bot`,e.text),v(e.options)},1e3)},x=()=>{let e=l.value.trim();e&&(_(`user`,e),l.value=``,c.innerHTML=``,m(),setTimeout(()=>{h();let n=e.toLowerCase(),r=`default`;n.match(/(daftar|syarat|biaya|cara|proses|registrasi|kemenag)/)?r=`daftar`:n.match(/(sakit)/)?r=`pelimpahan_sakit`:n.match(/(meninggal|wafat|mati|kematian|waris)/)?r=`pelimpahan_meninggal`:n.match(/(pelimpahan|kuota|porsi)/)?r=`pelimpahan`:n.match(/(batal|refund|tarik)/)?r=`batal`:n.match(/(tunggu|antri|estimasi|tahun|berangkat|cek)/)?r=`tunggu`:n.match(/(aplikasi|satuhaji|satu haji|playstore|play store|download|unduh)/)?r=`satuhaji`:n.match(/(kontak|whatsapp|wa|nomor|telepon|petugas|cs|admin)/)&&(r=`petugas`);let i=t[r];_(`bot`,i.text),v(i.options)},1200))};u.addEventListener(`click`,x),l.addEventListener(`keydown`,e=>{e.key===`Enter`&&x()})});function e(e){if(navigator.clipboard&&window.isSecureContext)return navigator.clipboard.writeText(e);{let t=document.createElement(`textarea`);return t.value=e,t.style.position=`fixed`,t.style.left=`-999999px`,t.style.top=`-999999px`,document.body.appendChild(t),t.focus(),t.select(),new Promise((e,n)=>{let r=document.execCommand(`copy`);t.remove(),r?e():n(Error(`Copy command failed`))})}}function t(e){let t=document.getElementById(`news-share-toast`);t||(t=document.createElement(`div`),t.id=`news-share-toast`,t.className=`share-toast`,document.body.appendChild(t)),t.innerHTML=`
        <span class="share-toast-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </span>
        <span class="share-toast-msg">${e}</span>
    `,t.classList.add(`is-visible`),clearTimeout(t._timeout),t._timeout=setTimeout(()=>{t.classList.remove(`is-visible`)},3e3)}document.addEventListener(`click`,async n=>{let r=n.target.closest(`.js-copy-link`);if(r){n.preventDefault();let i=r.dataset.url||window.location.href;try{await e(i),t(`Tautan berita berhasil disalin ke clipboard!`);let n=r.querySelector(`.icon-copy`),a=r.querySelector(`.icon-check`),o=r.querySelector(`.copy-text`);r.classList.add(`is-copied`),n&&n.classList.add(`is-hidden`),a&&a.classList.remove(`is-hidden`),o&&(o.textContent=`Tersalin!`),setTimeout(()=>{r.classList.remove(`is-copied`),n&&n.classList.remove(`is-hidden`),a&&a.classList.add(`is-hidden`),o&&(o.textContent=`Salin Tautan`)},2500)}catch{t(`Gagal menyalin tautan.`)}return}let i=n.target.closest(`.js-share-instagram`);if(i){n.preventDefault();let r=i.dataset.url||window.location.href,a=i.dataset.title||document.title;if(navigator.share)try{await navigator.share({title:a,text:`${a}\n\n${r}`,url:r});return}catch(e){if(e.name===`AbortError`)return}try{await e(r),t(`Tautan disalin! Buka Instagram untuk membagikan.`),setTimeout(()=>{window.open(`https://www.instagram.com/`,`_blank`,`noopener,noreferrer`)},800)}catch{window.open(`https://www.instagram.com/`,`_blank`,`noopener,noreferrer`)}return}});