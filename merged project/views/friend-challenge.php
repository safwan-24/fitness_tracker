<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Friend Challenge</title>
  <link rel="stylesheet" href="../assets/styles/style.css" />
</head>
<body>
  <main>
    <h1>Create a Step or Workout Challenge</h1>
    <form id="challengeForm" novalidate>
      <div class="form-group">
        <label for="challengeName">Challenge Name</label>
        <input type="text" id="challengeName" name="challengeName" required />
        <small class="error-message"></small>
      </div>

      <div class="form-group">
        <label for="challengeType">Challenge Type</label>
        <select id="challengeType" name="challengeType" required>
          <option value="">Select a type</option>
          <option value="steps">Steps</option>
          <option value="workout">Workout</option>
        </select>
        <small class="error-message"></small>
      </div>

      <div class="form-group">
        <label for="target">Target (number)</label>
        <input
          type="number"
          id="target"
          name="target"
          min="1"
          step="1"
          required
          placeholder="Enter a positive number"
        />
        <small class="error-message"></small>
      </div>

      <button type="submit">Create Challenge</button>
    </form>
  </main>

  <script src="../assets/scripts/friend-challenge.js"></script>
</body>
</html>
