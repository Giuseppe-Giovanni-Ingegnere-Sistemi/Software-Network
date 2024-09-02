document.getElementById('sendButton').addEventListener('click', sendMessage);
document.getElementById('messageInput').addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
        sendMessage();
    }
});

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const messageText = messageInput.value.trim();

    if (messageText !== '') {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'self');
        messageElement.textContent = messageText;

        document.getElementById('chatMessages').appendChild(messageElement);
        messageInput.value = '';
        messageInput.focus();

        // Simulación de respuesta automática
        setTimeout(() => {
            const replyElement = document.createElement('div');
            replyElement.classList.add('message', 'other');
            replyElement.textContent = 'Respuesta automática';
            document.getElementById('chatMessages').appendChild(replyElement);
            document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
        }, 1000);

        document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
    }
}
