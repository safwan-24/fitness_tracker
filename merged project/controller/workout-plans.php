<?php
session_start();
require_once "../model/dbconnection.php";

// Accept JSON input
$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate JSON input
    if (!$input) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
        exit;
    }

    // Extract and validate data
    $program = isset($input['program']) ? filter_var($input['program'], FILTER_VALIDATE_INT) : null;
    $goal = isset($input['goal']) ? filter_var($input['goal'], FILTER_SANITIZE_STRING) : null;
    $startDate = isset($input['startDate']) ? filter_var($input['startDate'], FILTER_SANITIZE_STRING) : null;

    // Validation
    $errors = [];

    // Validate program duration
    $validPrograms = [4, 6, 8, 12];
    if (!in_array($program, $validPrograms)) {
        $errors[] = "Invalid program duration";
    }

    // Validate goal
    $validGoals = ['strength', 'fat_loss', 'flexibility', 'endurance'];
    if (!in_array($goal, $validGoals)) {
        $errors[] = "Invalid workout goal";
    }

    // Validate start date
    if (!$startDate || !strtotime($startDate)) {
        $errors[] = "Invalid start date";
    } else {
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        $startDateTime = new DateTime($startDate);
        if ($startDateTime < $today) {
            $errors[] = "Start date cannot be in the past";
        }
    }

    // If there are validation errors
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => implode(", ", $errors)
        ]);
        exit;
    }

    try {
        // Prepare SQL statement using mysqli
        $sql = "INSERT INTO workplann (program_duration, goal, start_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("iss", $program, $goal, $startDate);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Workout plan created successfully',
                    'data' => [
                        'program' => $program,
                        'goal' => $goal,
                        'startDate' => $startDate
                    ]
                ]);
            } else {
                throw new Exception('Failed to save workout plan: ' . $stmt->error);
            }
            
            $stmt->close();
        } else {
            throw new Exception('Failed to prepare statement: ' . $conn->error);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
    exit;
}

// If accessed with wrong method
http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Method not allowed']);
exit;
?>
