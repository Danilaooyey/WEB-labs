document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("form");
    
    if (form) {
        form.addEventListener("submit", async function(event) {
            event.preventDefault();
            
            const username = document.getElementById("username")?.value;
            const password = document.getElementById("password")?.value;
            
            
            const route = form.getAttribute("action"); 
            try {
                const response = await fetch(route, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
                });
                
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    const result = await response.text();
                    alert(result);
                }
            } catch (error) {
                alert("Error: " + error.message);
            }
        });
    }
});