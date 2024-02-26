const adminAuth = ["admin", "auth"];

export const adminPolicy = {
  admin: [
    [adminAuth],
    {
      brand: [
        [adminAuth],
        {
          id: [[adminAuth]],
          create: [[adminAuth]],
        },
      ],
      perfume: [
        [adminAuth],
        {
          id: [
            [adminAuth],
            {
              image: [[adminAuth]],
              information: [[adminAuth]],
              price: [[adminAuth]],
            },
          ],
          create: [[adminAuth]],
        },
      ],
    },
  ],
};
