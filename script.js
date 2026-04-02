/* ============================================
   LEAN GENIE ADVISORS - COMPLETE JAVASCRIPT
   Interactive Features & Functionality
   ============================================ */

// ============================================
// UTILITY FUNCTIONS
// ============================================

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function scrollToSection(selector) {
    const element = document.querySelector(selector);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

// ============================================
// HEADER NAVIGATION
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    
    window.addEventListener('scroll', function() {
        let current = '';
        
        document.querySelectorAll('section[id]').forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').slice(1) === current) {
                link.classList.add('active');
            }
        });
    });
});

// ============================================
// QUOTE CAROUSEL
// ============================================

let currentQuoteIndex = 0;
let quoteAutoRotateInterval;

function updateQuoteCarousel() {
    const quoteItems = document.querySelectorAll('.quote-item');
    const quoteDots = document.querySelectorAll('.carousel-dot');
    
    quoteItems.forEach((item, index) => {
        item.classList.remove('active');
        if (quoteDots[index]) {
            quoteDots[index].classList.remove('active');
        }
    });
    
    quoteItems[currentQuoteIndex].classList.add('active');
    if (quoteDots[currentQuoteIndex]) {
        quoteDots[currentQuoteIndex].classList.add('active');
    }
}

function initializeQuoteCarousel() {
    const quoteItems = document.querySelectorAll('.quote-item');
    const quoteDots = document.getElementById('quoteDots');
    
    if (quoteDots && quoteItems.length > 0) {
        // Create dots
        quoteItems.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = 'carousel-dot' + (index === 0 ? ' active' : '');
            dot.onclick = () => {
                currentQuoteIndex = index;
                clearInterval(quoteAutoRotateInterval);
                updateQuoteCarousel();
                startAutoRotate();
            };
            quoteDots.appendChild(dot);
        });
        
        updateQuoteCarousel();
        startAutoRotate();
    }
}

function nextQuote() {
    const quoteItems = document.querySelectorAll('.quote-item');
    currentQuoteIndex = (currentQuoteIndex + 1) % quoteItems.length;
    clearInterval(quoteAutoRotateInterval);
    updateQuoteCarousel();
    startAutoRotate();
}

function previousQuote() {
    const quoteItems = document.querySelectorAll('.quote-item');
    currentQuoteIndex = (currentQuoteIndex - 1 + quoteItems.length) % quoteItems.length;
    clearInterval(quoteAutoRotateInterval);
    updateQuoteCarousel();
    startAutoRotate();
}

function startAutoRotate() {
    quoteAutoRotateInterval = setInterval(() => {
        nextQuote();
    }, 8000);
}

// Initialize carousel when DOM is ready
document.addEventListener('DOMContentLoaded', initializeQuoteCarousel);

// ============================================
// INDUSTRIES TABS
// ============================================

function initializeTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
        });
    });
}

document.addEventListener('DOMContentLoaded', initializeTabs);

// ============================================
// CASE STUDIES ACCORDION
// ============================================

function toggleAccordion(header) {
    const content = header.nextElementSibling;
    const isActive = content.classList.contains('active');
    
    // Close all other accordions
    document.querySelectorAll('.accordion-content').forEach(item => {
        item.classList.remove('active');
    });
    
    // Toggle current accordion
    if (!isActive) {
        content.classList.add('active');
    }
}

// ============================================
// GLOBAL IMPACT FILTERS
// ============================================

function filterImpact(region) {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const impactCards = document.querySelectorAll('.impact-card');
    
    // Update active button
    filterBtns.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Filter cards
    impactCards.forEach(card => {
        if (region === 'all' || card.getAttribute('data-region') === region) {
            card.classList.remove('hidden');
        } else {
            card.classList.add('hidden');
        }
    });
}

// ============================================
// FORM HANDLING
// ============================================

function handleFormSubmit(event, formType) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    // Validate form
    if (!validateForm(data, formType)) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }
    
    // Simulate form submission
    console.log(`${formType} Form Submitted:`, data);
    
    // Show success notification
    showNotification('Thank you! We\'ll be in touch soon.', 'success');
    
    // Reset form
    form.reset();
    
    // In a real application, you would send this data to a server
    // Example:
    // fetch('/api/submit-form', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify(data)
    // })
    // .then(response => response.json())
    // .then(result => {
    //     showNotification('Thank you! We\'ll be in touch soon.', 'success');
    //     form.reset();
    // })
    // .catch(error => {
    //     showNotification('An error occurred. Please try again.', 'error');
    //     console.error('Error:', error);
    // });
}

function validateForm(data, formType) {
    if (formType === 'career') {
        return data.name && data.phone && data.email && data.resume;
    } else if (formType === 'schedule') {
        return data.name && data.email && data.company && data.date && data.topic;
    } else if (formType === 'contact') {
        return data.name && data.email && data.message;
    }
    return true;
}

// ============================================
// NOTIFICATIONS
// ============================================

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 24px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        border-radius: 8px;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        font-weight: 500;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after 4 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// ============================================
// SCROLL ANIMATIONS
// ============================================

function initializeScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all cards and sections
    document.querySelectorAll('.service-card, .stat-card, .resource-card, .impact-card, .benefit-card').forEach(element => {
        element.style.opacity = '0';
        observer.observe(element);
    });
}

document.addEventListener('DOMContentLoaded', initializeScrollAnimations);

// ============================================
// COUNTER ANIMATIONS
// ============================================

function animateCounter(element, target, duration = 2000) {
    let current = 0;
    const increment = target / (duration / 16);
    
    const counter = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(counter);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

function initializeCounters() {
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.stat-number');
                statNumbers.forEach(num => {
                    const text = num.textContent;
                    const targetValue = parseInt(text) || parseInt(text.replace(/\D/g, ''));
                    if (targetValue) {
                        animateCounter(num, targetValue);
                    }
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.stats-grid').forEach(grid => {
        observer.observe(grid);
    });
}

document.addEventListener('DOMContentLoaded', initializeCounters);

// ============================================
// SMOOTH SCROLL TO TOP BUTTON
// ============================================

function initializeScrollToTopButton() {
    const scrollButton = document.createElement('button');
    scrollButton.innerHTML = '↑';
    scrollButton.className = 'scroll-to-top';
    scrollButton.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        z-index: 999;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
    `;
    
    document.body.appendChild(scrollButton);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollButton.style.display = 'flex';
        } else {
            scrollButton.style.display = 'none';
        }
    });
    
    scrollButton.addEventListener('click', scrollToTop);
    
    scrollButton.addEventListener('mouseover', () => {
        scrollButton.style.transform = 'scale(1.1)';
    });
    
    scrollButton.addEventListener('mouseout', () => {
        scrollButton.style.transform = 'scale(1)';
    });
}

document.addEventListener('DOMContentLoaded', initializeScrollToTopButton);

// ============================================
// KEYBOARD NAVIGATION
// ============================================

document.addEventListener('keydown', function(event) {
    // Arrow keys for carousel
    if (event.key === 'ArrowRight') {
        const quoteItems = document.querySelectorAll('.quote-item');
        if (quoteItems.length > 0) {
            nextQuote();
        }
    } else if (event.key === 'ArrowLeft') {
        const quoteItems = document.querySelectorAll('.quote-item');
        if (quoteItems.length > 0) {
            previousQuote();
        }
    }
    
    // Escape key for modals (if needed)
    if (event.key === 'Escape') {
        // Handle modal close if needed
    }
});

// ============================================
// LAZY LOADING IMAGES
// ============================================

function initializeLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

document.addEventListener('DOMContentLoaded', initializeLazyLoading);

// ============================================
// FORM FIELD VALIDATION
// ============================================

function initializeFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('focus', function() {
                this.style.borderColor = '#7c3aed';
            });
        });
    });
}

function validateField(field) {
    if (field.hasAttribute('required') && !field.value.trim()) {
        field.style.borderColor = '#ef4444';
        field.style.background = 'rgba(239, 68, 68, 0.05)';
    } else if (field.type === 'email' && field.value && !isValidEmail(field.value)) {
        field.style.borderColor = '#ef4444';
    } else {
        field.style.borderColor = '#3f2c5c';
        field.style.background = 'rgba(124, 58, 237, 0.05)';
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

document.addEventListener('DOMContentLoaded', initializeFormValidation);

// ============================================
// MOBILE MENU TOGGLE (if needed)
// ============================================

function initializeMobileMenu() {
    const navLinks = document.querySelector('.nav-links');
    const header = document.querySelector('.header');
    
    // Check if we need mobile menu
    if (window.innerWidth <= 768) {
        // Mobile menu logic here if needed
    }
    
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            if (navLinks) navLinks.style.display = 'flex';
        }
    });
}

document.addEventListener('DOMContentLoaded', initializeMobileMenu);

// ============================================
// PARALLAX EFFECT
// ============================================

function initializeParallax() {
    const heroSection = document.querySelector('.hero');
    
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrollPosition = window.pageYOffset;
            heroSection.style.backgroundPosition = `0 ${scrollPosition * 0.5}px`;
        });
    }
}

document.addEventListener('DOMContentLoaded', initializeParallax);

// ============================================
// ADD ANIMATIONS TO STYLESHEET
// ============================================

const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .scroll-to-top:hover {
        background: linear-gradient(135deg, #a78bfa, #7c3aed) !important;
    }
`;
document.head.appendChild(style);

// ============================================
// INITIALIZATION ON PAGE LOAD
// ============================================

window.addEventListener('load', function() {
    console.log('Lean Genie Advisors website loaded successfully!');
    
    // Initialize all components
    initializeQuoteCarousel();
    initializeTabs();
    initializeScrollAnimations();
    initializeCounters();
    initializeScrollToTopButton();
    initializeLazyLoading();
    initializeFormValidation();
    initializeMobileMenu();
    initializeParallax();
});

// ============================================
// UTILITY: Debounce function
// ============================================

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ============================================
// UTILITY: Throttle function
// ============================================

function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ============================================
// EXPORT FUNCTIONS FOR EXTERNAL USE
// ============================================

window.scrollToTop = scrollToTop;
window.scrollToSection = scrollToSection;
window.toggleAccordion = toggleAccordion;
window.filterImpact = filterImpact;
window.handleFormSubmit = handleFormSubmit;
window.nextQuote = nextQuote;
window.previousQuote = previousQuote;
window.showNotification = showNotification;
