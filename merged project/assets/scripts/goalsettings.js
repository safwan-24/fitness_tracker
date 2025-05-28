document.getElementById('goalForm').addEventListener('submit', function(e) {
  const title = this.title.value.trim();
  const type = this.type.value.trim();
  const targetValue = this.targetValue.value;
  const unit = this.unit.value.trim();
  const targetDate = this.targetDate.value;

  if (!title || !type || !unit || !targetDate) {
    alert("সব ফিল্ড অবশ্যই পূরণ করতে হবে।");
    e.preventDefault();
    return;
  }

  if (isNaN(targetValue) || targetValue <= 0) {
    alert("Target Value অবশ্যই ধনাত্মক সংখ্যা হতে হবে।");
    e.preventDefault();
  }
});
