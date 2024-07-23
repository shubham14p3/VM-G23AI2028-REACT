import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Container, Typography, List, ListItem, ListItemText, Box, Button } from '@mui/material';
import { styled } from '@mui/system';
import { useNavigate } from 'react-router-dom';

const StyledContainer = styled(Container)(({ theme }) => ({
  display: 'flex',
  flexDirection: 'column',
  justifyContent: 'center',
  alignItems: 'center',
  minHeight: '100vh',
  backgroundColor: '#f5f5f5',
  padding: theme.spacing(2),
  [theme.breakpoints.down('sm')]: {
    padding: '0 1rem',
  },
}));

const StyledBox = styled(Box)(({ theme }) => ({
  backgroundColor: '#ffffff',
  padding: theme.spacing(4),
  borderRadius: theme.shape.borderRadius,
  boxShadow: theme.shadows[5],
  width: '100%',
  maxWidth: '600px',
}));

const StyledListItem = styled(ListItem)(({ theme }) => ({
  backgroundColor: '#fafafa',
  marginBottom: theme.spacing(1),
  borderRadius: theme.shape.borderRadius,
  boxShadow: theme.shadows[1],
  '&:last-child': {
    marginBottom: 0,
  },
}));

const Users = () => {
  const [users, setUsers] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    axios.get(`${process.env.REACT_APP_SERVER_IP}/users`)
      .then(response => {
        setUsers(response.data);
      })
      .catch(error => {
        console.error(error);
      });
  }, []);

  const handleLogout = () => {
    // Clear any authentication tokens if necessary
    navigate('/login');
  };

  return (
    <StyledContainer>
      <StyledBox>
        <Typography variant="h4" component="h1" gutterBottom>
          Signed-up Users
        </Typography>
        <List>
          {users.map(user => (
            <StyledListItem key={user._id}>
              <ListItemText primary={user.username} />
            </StyledListItem>
          ))}
        </List>
        <Button variant="contained" color="secondary" onClick={handleLogout} fullWidth>
          Logout
        </Button>
      </StyledBox>
    </StyledContainer>
  );
};

export default Users;
