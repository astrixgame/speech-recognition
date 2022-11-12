window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

//Create speech recognition listener
const recognition = new SpeechRecognition();

//Don't change result
recognition.interimResults = false;

//Add listener on result 
recognition.addEventListener("result", (e) => {
    const text = Array.from(e.results).map((result) => result[0].transcript);

    //Send data to script.php for process
    $.post("script.php",{"data":text},function(data){console.log(data)});
});

//After recognition end start next round
recognition.addEventListener("end", () => {
    recognition.start();
});

//First start of recognition
recognition.start();