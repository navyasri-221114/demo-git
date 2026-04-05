// ==========================================
// JS Lab Task - Interactive Features
// Variables, Functions, Objects, Methods, Pop-ups, Events
// ==========================================

// 1. VARIABLES (let and const)
const DEPARTMENT = "Music & Arts";
let studentName = "Guest";

// Select DOM Elements
const welcomeText = document.getElementById("welcome-message");
const personalizeBtn = document.getElementById("personalize-btn");
const eventTitle = document.getElementById("event-title");
const eventSeats = document.getElementById("event-seats");
const bookTicketBtn = document.getElementById("book-ticket-btn");

// 3. FUNCTIONS (Using Arrow Function and Parameters)
// Reusable function to update any DOM element
const updateDOM = (element, content) => {
    if (element) {
        element.innerHTML = content;
    }
};

// Initial Setup using function
function initializeDashboard() {
    updateDOM(welcomeText, `Welcome ${studentName} to the ${DEPARTMENT} Department`);
}

// 2. OBJECTS & 4. METHODS
// Create an object representing a real-world entity with properties and a method Using 'this'
const concertEvent = {
    title: "Classical Vocal Fest",
    availableSeats: 50,
    
    // Method to book a seat dynamically
    bookTicket: function() {
        if (this.availableSeats > 0) {
            this.availableSeats--;
            return true;
        } else {
            return false;
        }
    }
};

// Access object properties using dot notation to set initial values
updateDOM(eventTitle, concertEvent.title);
updateDOM(eventSeats, `Available Seats: ${concertEvent.availableSeats}`);

// 6. EVENTS & EVENT LISTENERS
// Event: Initialize on load
window.addEventListener("load", initializeDashboard);

// 5. POP-UP BOXES & 6. EVENTS (Personalize Button)
if (personalizeBtn) {
    personalizeBtn.addEventListener("click", () => {
        // prompt() - Pop-up Box 1
        let userInput = prompt("What is your name to enroll in Music & Arts?", "Student");

        if (userInput !== null && userInput.trim() !== "") {
            // confirm() - Pop-up Box 2
            let confirmAction = confirm(`Do you want to save ${userInput} as your profile name?`);
            
            if (confirmAction) {
                // Reassign a let variable
                studentName = userInput;
                
                // Console Logging coverage (Test Case)
                console.log("Profile updated via Pop-up to:", studentName);
                
                // Update the DOM dynamically using proper JS Fundamentals
                updateDOM(welcomeText, `Welcome ${studentName} to the ${DEPARTMENT} Department`);
                
                // alert() - Pop-up Box 3
                alert(`Awesome! Successfully personalized for ${studentName}.`);
            }
        }
    });
}

// Event Listener for the Book Ticket method and Object update
if (bookTicketBtn) {
    bookTicketBtn.addEventListener("click", () => {
        // Calling an object method attached to User interaction
        let success = concertEvent.bookTicket();
        
        if (success) {
            // Log to console using Bracket Notation (Test Case)
            console.log(`Seat booked! Remaining seats: ${concertEvent["availableSeats"]}`); 
            
            // Update DOM dynamically indicating property update
            updateDOM(eventSeats, `Available Seats: <span style="color:red;">${concertEvent.availableSeats}</span>`);
            
            alert("Success! Your seat has been booked for the " + concertEvent.title);
        } else {
            alert("Sorry, this event is fully booked!");
        }
    });
}

// Another Event: Using mouseover/mouseout modifying style dynamically (Hover effects)
const dashboardCards = document.querySelectorAll(".card");

dashboardCards.forEach(card => {
    card.addEventListener("mouseover", () => {
        card.style.backgroundColor = "#ffeaa7"; // Change style on hover
        card.style.transform = "scale(1.05)";
        card.style.transition = "all 0.3s ease";
    });
    
    card.addEventListener("mouseout", () => {
        card.style.backgroundColor = "rgba(255, 255, 255, 0.85)"; // Reset style
        card.style.transform = "scale(1)";
    });
});
