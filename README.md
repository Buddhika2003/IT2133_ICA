# CSRF Protection Demo (Synchronizer Token Pattern)

This project demonstrates a Cross-Site Request Forgery (CSRF) vulnerability and shows how to fix it using the **Synchronizer Token Pattern**.  
It includes a vulnerable form, an attacker page, and a secure version using server-generated CSRF tokens.

---

# Features
- Demonstrates how CSRF attacks happen.
- Shows how to generate secure CSRF tokens in PHP.
- Implements token verification during form submission.
- Includes example attacker file for demonstration.

# Explanation 

CSRF: an attack that forces a victim’s browser to submit a request to a site where the victim is authenticated, making the site perform state-changing actions because the browser sends credentials (cookies).

Why vulnerable code fails: it trusts that a POST request came from the site’s form. Browsers will include cookies even for cross-site POSTs, so attackers can cause actions if no additional proof included.

Synchronizer Token Pattern: server creates a random token and stores it in the user’s session. The legitimate form includes this token as hidden input. On POST, the server verifies token matches session. Attacker cannot know the token (same-origin restriction prevents reading of target site’s pages/cookies).



