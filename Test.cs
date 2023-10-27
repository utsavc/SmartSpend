

private void LoadUserData()
        {
            
            string query = "SELECT fname, lastname, title FROM user"; // Modify this query as needed

            List<Researcher> users = new List<Researcher>();

            try
            {
                using (MySqlConnection connection = GetConnection())
                {
                    connection.Open();
                    using (MySqlCommand command = new MySqlCommand(query, connection))
                    {
                        using (MySqlDataReader reader = command.ExecuteReader())
                        {
                            while (reader.Read())
                            {
                                User user = new User
                                {
                                    fname = reader["fname"].ToString(),
                                    lastname = reader["lastname"].ToString(),
                                    title = reader["title"].ToString()
                                };
                                users.Add(user);
                            }
                        }
                    }
                }

                // Bind the list of users to the ListBox
                userListBox.ItemsSource = users;
            }
            catch (Exception ex)
            {
                MessageBox.Show($"An error occurred: {ex.Message}");
            }
        }



           public List<Researcher> LoadAllResearcher()
        {
            using (MySqlConnection conn = GetConnection())
            {
                conn.Open();
               string query = "SELECT fname, lastname, title FROM user"; // Modify this query as needed

            
                using (MySqlCommand cmd = new MySqlCommand(query, conn))
                using (MySqlDataReader reader = cmd.ExecuteReader())
                {
                    List<Researcher> researcher = new List<Researcher>();

                    while (reader.Read())
                    {
                        researcher.Add(new Researcher
                        {
                            Name = reader.IsDBNull(1) ? "" : reader.GetString(1), // Handle NULL for Level
                            Title = reader.IsDBNull(2) ? "" : reader.GetString(2), // Handle NULL for Start
                            LastName = reader.IsDBNull(3) ? "" : reader.GetString(3) // Handle NULL for End
                        });
                    }


                    return researcher;
                }
            }
        }
