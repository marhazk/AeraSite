/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetUser extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public User user;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     UserArg arg = (UserArg)argument;
/* 16 */     UserRes res = (UserRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     UserArg arg = (UserArg)argument;
/* 22 */     UserRes res = (UserRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/* 28 */         this.user = res.value;
/*    */       else
/* 30 */         this.user = null;
/* 31 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 37 */     synchronized (this)
/*    */     {
/* 39 */       this.retcode = 4;
/* 40 */       this.user = null;
/* 41 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetUser
 * JD-Core Version:    0.6.2
 */