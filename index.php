<?php
  // super basic visit logger
  $counterFile = 'visits.txt';
  if (!file_exists($counterFile)) file_put_contents($counterFile, 0);
  $visits = (int)file_get_contents($counterFile) + 1;
  file_put_contents($counterFile, $visits);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="A brutally honest Roman ↔ Arabic numeral converter and calculator. Come for the math, stay for the insults." />
  <meta name="keywords" content="Roman numeral converter, Arabic number tool, online calculator, rude calculator, insult math tool" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="Extremely Rude Softworks" />
  <meta property="og:title" content="Extremely Rude Number Convertor" />
  <meta property="og:description" content="Convert numbers and get insulted in the process. A judgmental tool for people who deserve it." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://rudeconverter.com" />
  <meta property="og:image" content="https://rudeconverter.com/social-preview.png" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Extremely Rude Number Convertor</title>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8613208072373455" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background-color: #111;
      color: #f5f5f5;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .light-theme { background-color: #f4f4f4; color: #111; }
    h1 { margin: 30px auto 10px; font-size: 2.8rem; color: #ff3e3e; text-align: center; text-shadow: 1px 1px 3px black; }
    .subtext { font-size: 1.1rem; color: #bbb; text-align: center; margin-bottom: 10px; }
    #dailyInsult {
      background-color: #2a0000;
      padding: 12px;
      border-radius: 8px;
      color: #ff5e5e;
      font-weight: bold;
      max-width: 600px;
      margin: 0 auto 20px;
      text-align: center;
      animation: popIn 1.5s forwards;
      opacity: 0;
    }
    .meta-nav {
      text-align: center;
      margin: 10px auto 20px;
    }
    .meta-nav a {
      color: #ff5e5e;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    .page-section {
      display: none;
      padding: 30px;
      text-align: center;
      max-width: 800px;
      margin: 0 auto;
    }
    .page-section.active {
      display: block;
    }
    @keyframes popIn {
      0% { opacity: 0; transform: scale(0.95); }
      50% { transform: scale(1.05); }
      100% { opacity: 1; transform: scale(1); }
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      padding: 20px 0;
    }
    .column {
      flex: 1;
      min-width: 300px;
      max-width: 480px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    input[type="text"] {
      padding: 12px;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #333;
      background: #1a1a1a;
      color: #fff;
    }
    button, input[type="submit"] {
      padding: 12px;
      font-size: 1rem;
      background-color: #ff3e3e;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover, input[type="submit"]:hover {
      background-color: #d10000;
    }
    .calculator {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }
    .calculator input[type="text"] {
      grid-column: span 4;
      text-align: right;
      padding-right: 10px;
    }
  </style>
</head>
<body>
  <h1>Extremely Rude Number Convertor</h1>
  <div class="subtext">A calculator and converter that hates your guts. You're welcome.</div>
  <div class="meta-nav">
    <a href="#" onclick="showSection('converter')">Converter</a>
    <a href="#" onclick="showSection('themes')">Themes</a>
    <a href="#" onclick="showSection('articles')">Articles</a>
    <a href="#" onclick="showSection('stats')">Stats</a>
    <a href="#" onclick="showSection('about')">About</a>
  </div>
  <div id="dailyInsult"></div>
  <div class="subtext">This site has been visited <strong><?php echo $visits; ?></strong> times. Still not enough.</div>

  <section id="converter" class="page-section active">
    <h2>Converter & Calculator</h2>
    <div class="container">
      <div class="column">
        <form id="convertForm">
          <input type="text" id="romanInput" placeholder="Enter Roman numerals (e.g. XIV)">
          <input type="text" id="arabicInput" placeholder="Enter Arabic numerals (e.g. 14)">
          <input type="submit" value="Convert or Cry">
        </form>
        <form id="insultForm">
          <input type="text" id="customInsult" placeholder="Submit your own insult...">
          <button type="button" onclick="submitInsult()">Submit Insult</button>
        </form>
        <div id="controls">
          <button onclick="insultMe()">Insult Me</button>
          <button onclick="toggleTheme()">Toggle Theme</button>
        </div>
      </div>
      <div class="column">
        <form class="calculator">
          <input type="text" id="calcDisplay" disabled>
          <button type="button" onclick="append('7')">7</button>
          <button type="button" onclick="append('8')">8</button>
          <button type="button" onclick="append('9')">9</button>
          <button type="button" onclick="append('/')">/</button>
          <button type="button" onclick="append('4')">4</button>
          <button type="button" onclick="append('5')">5</button>
          <button type="button" onclick="append('6')">6</button>
          <button type="button" onclick="append('*')">*</button>
          <button type="button" onclick="append('1')">1</button>
          <button type="button" onclick="append('2')">2</button>
          <button type="button" onclick="append('3')">3</button>
          <button type="button" onclick="append('-')">-</button>
          <button type="button" onclick="append('0')">0</button>
          <button type="button" onclick="append('.')">.</button>
          <button type="button" onclick="calculate()">=</button>
          <button type="button" onclick="append('+')">+</button>
          <button type="button" onclick="clearCalc()">C</button>
        </form>
      </div>
    </div>
    <button onclick="generateCertificate()">Print Certificate of Mathematical Shame</button>
</section>

  <section id="themes" class="page-section">
    <h2>Themes</h2>
    <p>Dark mode, light mode, and maybe 'clown mode' coming soon. Toggle your shame in style.</p>
  </section>

  <section id="articles" class="page-section">
  <h2>Articles</h2>
  <article>
    <h3>How to Solve Math Problems Without Crying</h3>
    <p>Let’s be real: math can be harder than explaining to your grandma what a meme is. But there’s hope. Let’s start with a classic: solving for x. Take the equation <strong>2x + 3 = 11</strong>. Step one, subtract 3 from both sides (because you’re trying to isolate x like it has a contagious personality). You get <strong>2x = 8</strong>. Now divide both sides by 2 (don’t cry) and bam: <strong>x = 4</strong>. Easy.</p>
    <p>Let’s level up: the quadratic formula. Remember this little gem?</p>
    <p style="text-align:center; font-weight:bold; font-size: 1.1em;">
      x = [-b ± √(b² - 4ac)] / 2a
    </p>
    <p>This is your go-to tool when you're facing a second-degree equation like <strong>x² + 3x - 4 = 0</strong>. Plug in your a, b, and c values, and crank that formula like you’re baking something disappointing.</p>
  </article>
  <article>
    <h3>Geometry for the Hopeless: Pythagoras to the Rescue</h3>
    <p>If you've ever looked at a triangle and panicked, congratulations — you're human. But Pythagoras? That guy made triangles his whole personality. His theorem is legendary:</p>
    <p style="text-align:center; font-weight:bold; font-size: 1.1em;">
      a² + b² = c²
    </p>
    <p>If a = 3 and b = 4, then <strong>c² = 9 + 16 = 25</strong>, so <strong>c = 5</strong>. Clean. Satisfying. Slightly smug.</p>
  </article>
  <article>
  <h3>Why Fractions Are Actually Evil</h3>
  <p>Let’s not sugarcoat it — fractions exist solely to ruin your day. Just when you think you’ve mastered whole numbers, some smug little slice like 3/7 rolls in and ruins the party. Dividing pizzas? Fine. Solving algebra with fractions? Absolute betrayal.</p>
  <p>To survive fractions, remember this: common denominators are the social glue of the fraction world. Without them, everything falls apart. Want to add 1/3 and 1/4? You can’t just smoosh them together like toddlers. You need to convert them to 4/12 and 3/12 first, then combine like civilized math people. The answer is 7/12, and yes, it’s still annoying.</p>
</article>

<article>
  <h3>Decimals vs. Fractions: The Pettiest War in Math</h3>
  <p>Some people like decimals. Others swear by fractions. Those people don’t talk to each other at math parties. Want to convert 0.25 to a fraction? It’s 1/4. See? They’re not so different. But use them wrong and your homework becomes a battlefield.</p>
  <p>Pro tip: decimals are great for calculators, fractions are great for exact answers. Use whichever causes less internal screaming. Unless you're doing taxes — then just cry either way.</p>
</article>

<article>
  <h3>Why You Still Can't Do Long Division</h3>
  <p>Long division isn’t long because of the steps — it’s long because of how long it takes your brain to accept it. Divide, multiply, subtract, bring down — it’s basically an emotional rollercoaster dressed up as math. And somehow it still shows up on tests like it’s 1995.</p>
  <p>If you forget the steps, just remember DMSB: Divide, Multiply, Subtract, Bring down. Or as we call it: Don't Mess Stuff Badly.</p>
</article>

<article>
  <h3>The Tragedy of Word Problems</h3>
  <p>Word problems are just math problems in disguise — badly written, confusing disguises. “If Jeff has 4 pencils and loses 2…” Why is Jeff so careless? What’s the story here? We don’t care. We want numbers, not this emotional subplot.</p>
  <p>To survive word problems: underline what matters, ignore the fluff, and channel your inner detective. Math Sherlock, not Math Hamlet.</p>
</article>

</section>
<section id="stats" class="page-section">
    <h2>Site Stats</h2>
    <p>Visit count: <?php echo $visits; ?>. Congrats, you’re part of the problem.</p>
  </section>

  <section id="about" class="page-section">
    <h2>About This Site</h2>
    <p>Made with sarcasm, sweat, and semicolons. For those who can't do math without being judged.</p>
  </section>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const insults = [
      "Your calculator is crying.",
      "Wow, even the Roman Empire would collapse reading that.",
      "Your math is worse than your attitude.",
      "You're the human version of a 404 error.",
      "This site wasn't built for this level of nonsense."
    ];

    function showSection(id) {
      document.querySelectorAll('.page-section').forEach(sec => sec.classList.remove('active'));
      const selected = document.getElementById(id);
      if (selected) selected.classList.add('active');
    }

    function submitInsult() {
      const input = document.getElementById("customInsult");
      if (!input || !input.value.trim()) {
        alert("Try writing a real insult, coward.");
        return;
      }
      alert("Your insult has been submitted and will traumatize users for 24 hours. Congratulations.");
      input.value = "";
      confetti();
    }

    function insultMe() {
      const box = document.getElementById("dailyInsult");
      const insult = insults[Math.floor(Math.random() * insults.length)];
      box.textContent = insult;
      box.style.opacity = 1;
    }

    function toggleTheme() {
      document.body.classList.toggle("light-theme");
    }

    function romanToInt(roman) {
      const validPattern = /^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/i;
      if (!validPattern.test(roman)) {
        alert("Invalid Roman numeral syntax. Julius Caesar is disappointed.");
        return "";
      }
      const map = {I:1, V:5, X:10, L:50, C:100, D:500, M:1000};
      let total = 0, prev = 0;
      roman = roman.toUpperCase();
      for (let i = roman.length - 1; i >= 0; i--) {
        const curr = map[roman[i]];
        total += curr < prev ? -curr : curr;
        prev = curr;
      }
      return total;
    }

    function intToRoman(num) {
      if (num <= 0 || num >= 4000) return 'Too big. Or too tiny. Like your brain.';
      const val = [
        [1000, 'M'], [900, 'CM'], [500, 'D'], [400, 'CD'],
        [100, 'C'], [90, 'XC'], [50, 'L'], [40, 'XL'],
        [10, 'X'], [9, 'IX'], [5, 'V'], [4, 'IV'], [1, 'I']
      ];
      let result = '';
      for (const [n, r] of val) {
        while (num >= n) {
          result += r;
          num -= n;
        }
      }
      return result;
    }

    function append(val) {
      const display = document.getElementById("calcDisplay");
      display.value += val;
    }

    function clearCalc() {
      document.getElementById("calcDisplay").value = "";
    }

    function calculate() {
      const display = document.getElementById("calcDisplay");
      try {
        const result = eval(display.value);
        if (!isFinite(result)) throw new Error();
        display.value = result;
      } catch {
        display.value = "Error";
        alert("Congratulations, you've broken math. Again.");
      }
    }

    function generateCertificate() {
      const certificateWindow = window.open('', '', 'width=800,height=600');
      certificateWindow.document.write(`
        <html>
          <head>
            <title>Certificate of Mathematical Shame</title>
            <style>
              body {
                font-family: 'Comic Sans MS', sans-serif;
                background-color: #fff0f0;
                color: #900;
                text-align: center;
                padding: 50px;
              }
              h1 {
                font-size: 3em;
                margin-bottom: 20px;
                color: #c00;
              }
              p {
                font-size: 1.5em;
              }
              .stamp {
                margin-top: 40px;
                font-size: 2em;
                transform: rotate(-15deg);
                color: #d00;
                font-weight: bold;
                border: 3px dashed #d00;
                display: inline-block;
                padding: 10px 20px;
              }
            </style>
          </head>
          <body>
            <h1>Certificate of Mathematical Shame</h1>
            <p>This certifies that <strong>you</strong> did something so mathematically tragic<br>we felt the need to print this.</p>
            <p>Please hang this somewhere visible as a warning to others.</p>
            <div class="stamp">SHAME!</div>
            <script>setTimeout(function() { window.print(); }, 500);<\/script>
          </body>
        </html>
      `);
      certificateWindow.document.close();
    }

    // Attach event listeners
    document.getElementById("convertForm").addEventListener("submit", function(event) {
      event.preventDefault();
      const romanInput = document.getElementById("romanInput").value.trim();
      const arabicInput = document.getElementById("arabicInput").value.trim();
      if (romanInput && !arabicInput) {
        document.getElementById("arabicInput").value = romanToInt(romanInput);
      } else if (!romanInput && arabicInput) {
        const num = parseInt(arabicInput);
        if (isNaN(num)) {
          alert("That's not a number, champ.");
        } else {
          document.getElementById("romanInput").value = intToRoman(num);
        }
      } else {
        alert("Pick one input field. Not both. This isn't rocket science.");
      }
    });

    document.getElementById("dailyInsult").textContent = insults[Math.floor(Math.random() * insults.length)];
    document.getElementById("dailyInsult").style.opacity = 1;

    window.insultMe = insultMe;
    window.toggleTheme = toggleTheme;
    window.submitInsult = submitInsult;
    window.append = append;
    window.clearCalc = clearCalc;
    window.calculate = calculate;
    window.generateCertificate = generateCertificate;
    window.showSection = showSection;
  });
</script>
</body>
</html>
</script>
</body>
</html>
</script>
</body>
</html>
