-- Add video_file column to popup_video table
ALTER TABLE popup_video ADD COLUMN IF NOT EXISTS video_file VARCHAR(255) NULL AFTER id;

-- Make video_url nullable if it isn't already
ALTER TABLE popup_video MODIFY COLUMN video_url VARCHAR(255) NULL;
