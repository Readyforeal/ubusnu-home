import Keyboard from "simple-keyboard";
import "simple-keyboard/build/css/index.css";

// --- existing keyboard.js code ---
// currentInput tracking
let currentInput = null;

document.addEventListener("focusin", (e) => {
    if (e.target.matches("[data-keyboard-target]")) {
        currentInput = e.target;

        // Load the current value into the keyboard
        if (window.keyboard) window.keyboard.setInput(currentInput.value);
    }
});

function getInput() {
    return currentInput;
}

// createKeyboard function
function createKeyboard(container) {
    if (!container) return;

    // Destroy previous instance if it exists
    if (window.keyboard) {
        window.keyboard.destroy();
    }

    window.keyboard = new Keyboard(container, {
        onChange: (input) => {
            const el = getInput();
            if (!el) return;

            el.value = input;
            el.dispatchEvent(new Event("input")); // Livewire sync
        },

        layout: {
            default: [
                "1 2 3 4 5 6 7 8 9 0",
                "q w e r t y u i o p",
                "a s d f g h j k l",
                "{shift} z x c v b n m {backspace}",
                "{space}"
            ],
            shift: [
                "! @ # $ % ^ & * ( )",
                "Q W E R T Y U I O P",
                "A S D F G H J K L",
                "{shift} Z X C V B N M {backspace}",
                "{space}"
            ]
        },

        display: {
            "{shift}": "⇧",
            "{backspace}": "⌫",
            "{space}": " ",
        },

        layoutName: "default",
        onKeyPress: (button) => handleKeyPress(button),
    });
}

// handleKeyPress function
function handleKeyPress(button) {
    const current = window.keyboard.options.layoutName;

    if (button === "{shift}") {
        const next = current === "default" ? "shift" : "default";
        window.keyboard.setOptions({ layoutName: next });
        return;
    }

    if (current === "shift") {
        window.keyboard.setOptions({ layoutName: "default" });
    }
}

// --- Event logic goes here ---
document.addEventListener("keyboard-mount", (e) => {
    const selector = e.detail.target;
    const container = document.querySelector(selector);

    if (!container) {
        console.warn("Keyboard target not found:", selector);
        return;
    }

    createKeyboard(container);
});

document.addEventListener("keyboard-destroy", (e) => {
    if (window.keyboard) {
        window.keyboard.destroy();
        window.keyboard = null;
    }
});
