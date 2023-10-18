
/* Atribui ao evento keypress do input number a função para formatar o número de telefone*/
var inputCPF = document.getElementById("number");
if (inputCPF != null && inputCPF.addEventListener) {                   
    inputCPF.addEventListener("keypress", function(){mascaraTexto(this, '## #####-####')});
} else if (inputCPF != null && inputCPF.attachEvent) {                  
    inputCPF.attachEvent("onkeypress", function(){mascaraTexto(this, '## #####-####')});
}