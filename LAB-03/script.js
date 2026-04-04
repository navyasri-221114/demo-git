// ==========================================
// Web Technology Lab Task-4
// JavaScript Fundamentals (Variables, Functions, Objects, Methods, Pop-ups, Events)
// ==========================================

console.log("----- 1. VARIABLES TEST CASES -----");

// 1. Declare variables using let and const
const DEPARTMENT_NAME = "Music & Arts"; // const: value cannot be changed
let totalStudents = 350; // let: value can change

// 2. Log variable values in the console
console.log("Department Name (const):", DEPARTMENT_NAME);
console.log("Initial Students (let):", totalStudents);

// 3. Attempt reassignment of const and observe behavior
try {
    DEPARTMENT_NAME = "Science Department"; 
} catch (error) {
    console.warn("Expected Error: Cannot reassign const variable 'DEPARTMENT_NAME'. Message:", error.message);
}

// 4. Demonstrate reassignment using let
totalStudents = 351; // Reassigning a let variable dynamically
console.log("Updated Student count after reassignment (let):", totalStudents);


console.log("\n----- 2. FUNCTIONS TEST CASES -----");

// Function Declaration (With Parameters and Return Value)
function calculateAvailableSpots(maximumCapacity, currentEnrolled) {
    return maximumCapacity - currentEnrolled;
}

// Function Expression (Reusable DOM Updater)
const updateDOMContent = function(elementId, htmlContent) {
    const element = document.getElementById(elementId);
    if(element) {
        element.innerHTML = htmlContent;
    }
};

// Arrow Function
const getWelcomeMessage = (userName) => {
    return `Welcome to the ${DEPARTMENT_NAME} Department, ${userName}! Join us in making melodies.`;
};

// Displaying variable values in the DOM using the function expression
updateDOMContent("student-count-display", `<strong>Current Enrolled Students:</strong> ${totalStudents} (Spots Left: ${calculateAvailableSpots(500, totalStudents)})`);


console.log("\n----- 3. OBJECTS & 4. METHODS TEST CASES -----");

// 1. Create a JavaScript Object with min 3 properties
const departmentProfile = {
    theme: "Classical Music & Arts",
    headOfDept: "Dr. Sharma",
    coursesAvailable: 12,
    
    // 2. Define at least one method inside the object updating object data using 'this'
    addNewCourse: function(courseName) {
        this.coursesAvailable += 1;
        console.log(`New course '${courseName}' has been added!`);
        console.log(`Total courses are now: ${this.coursesAvailable}`);
    },

    // 3. Method accessing object properties logically
    getDisplayInfo: function() {
        return `<strong>Theme:</strong> ${this.theme} <br/> <strong>Head Professor:</strong> ${this.headOfDept} <br/> <strong>Active Courses:</strong> ${this.coursesAvailable}`;
    }
};

// Console logging the entire object
console.log("Department Object:", departmentProfile);

// Dot Notation Access
console.log("Head of Dept (Dot notation):", departmentProfile.headOfDept);

// Bracket Notation Access
console.log("Theme (Bracket notation):", departmentProfile["theme"]);

// Property Update (Updating object properties dynamically)
departmentProfile.headOfDept = "Prof. Rajan"; 
console.log("Updated Head of Dept:", departmentProfile.headOfDept);

// Display Object Data on the webpage
updateDOMContent("dept-title", `Object Detail Panel`);
updateDOMContent("dept-details", departmentProfile.getDisplayInfo());


console.log("\n----- 5. POP-UP BOXES & 6. EVENTS TEST CASES -----");

// Select DOM Elements
const enrollBtn = document.getElementById("enroll-btn");
const changeThemeBtn = document.getElementById("change-theme-btn");
const surveyBtn = document.getElementById("survey-btn");
const visitorMessage = document.getElementById("visitor-message");

// EVENT 1: Click Event (Modifies Content + Uses Confirm/Alert)
// Use addEventListener instead of onclick
enrollBtn.addEventListener("click", () => {
    // confirm() pop-up for yes/no decisions
    const confirmEnroll = confirm("Are you sure you want to enroll a new student to the department?");
    
    if (confirmEnroll) {
        // Variable update & DOM Content update
        totalStudents++;
        updateDOMContent("student-count-display", `<strong>Current Enrolled Students:</strong> ${totalStudents} (Spots Left: ${calculateAvailableSpots(500, totalStudents)})`);
        
        // Trigger Method by User Action
        departmentProfile.addNewCourse("Advanced Vocal Symphony");
        
        // Method triggered updates object display in DOM
        updateDOMContent("dept-details", departmentProfile.getDisplayInfo());
        
        // alert() pop-up for notifications
        alert("Student successfully enrolled and a new course was launched!");
    } else {
        alert("Enrollment action was cancelled.");
    }
});

// EVENT 2: Mouseover Event (Modifies Style)
changeThemeBtn.addEventListener("mouseover", () => {
    changeThemeBtn.style.backgroundColor = "green";
    changeThemeBtn.style.color = "yellow";
    changeThemeBtn.innerText = "Hover Active!";
});

// EVENT 3: Mouseout Event (Modifies Style)
changeThemeBtn.addEventListener("mouseout", () => {
    changeThemeBtn.style.backgroundColor = "#003366";
    changeThemeBtn.style.color = "white";
    changeThemeBtn.innerText = "Hover Me (Style Change)";
});

// EVENT 4: Click Event (Uses Prompt, Modifies DOM Element Attribute & Content)
surveyBtn.addEventListener("click", () => {
    // prompt() pop-up for user input
    let visitorName = prompt("Please enter your name to take the visitor survey:", "Guest");
    
    // Check user decision based on user input
    if (visitorName !== null && visitorName.trim() !== "") {
        // Use Arrow Function
        let message = getWelcomeMessage(visitorName);
        
        // Display user responses on the webpage
        visitorMessage.innerHTML = `<span style='color: green; font-weight: bold;'>${message}</span>`;
        
        // Update DOM Attributes dynamically
        surveyBtn.setAttribute("disabled", "true");
        surveyBtn.style.opacity = "0.5";
        surveyBtn.innerText = "Survey Taken";
    } else {
        visitorMessage.innerHTML = "<span style='color: red;'>Survey cancelled because no name was provided.</span>";
    }
});
