// Fungsi untuk mengirim pesan pengguna ke GPT-3
function sendMessageToGPT(message) {
    // Kirim pesan pengguna ke API GPT-3 menggunakan fetch atau metode lainnya
    // Ganti 'YOUR_API_KEY' dengan kunci API GPT-3 yang sebenarnya
    fetch('https://api.openai.com/v1/engines/davinci-codex/completions', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer YOUR_API_KEY',
        },
        body: JSON.stringify({
            prompt: message,
            max_tokens: 150,
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Tampilkan balasan dari GPT-3 di kotak obrolan
        displayChatMessage("GPT-3", data.choices[0].text.trim());
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Fungsi untuk menampilkan pesan dalam kotak obrolan
function displayChatMessage(sender, message) {
    var chatBox = document.getElementById('chat-box');
    var chatMessage = document.createElement('p');
    chatMessage.textContent = sender + ": " + message;
    chatBox.appendChild(chatMessage);
}

// Fungsi untuk mengirim pesan
function sendMessage() {
    var userInput = document.getElementById('user-input').value;
    
    // Menambahkan input pengguna ke kotak obrolan
    displayChatMessage("User", userInput);

    // Mengirim pesan pengguna ke GPT-3 dan menampilkan balasan
    sendMessageToGPT(userInput);

    // Membersihkan input pengguna
    document.getElementById('user-input').value = "";
}