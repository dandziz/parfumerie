const userAuth = ["user", "auth"];

export const userPolicy = {
  customer: [
    [userAuth],
    {
      order: [
        [userAuth],
        {
          id: [[userAuth]],
        },
      ],
      address: [[userAuth],],
      'change-password': [[userAuth],],
      cart: [[userAuth],],
    },
  ],
};
