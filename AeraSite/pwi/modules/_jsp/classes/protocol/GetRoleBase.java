/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleBase extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleBase base;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     RoleId arg = (RoleId)argument;
/* 16 */     RoleBaseRes res = (RoleBaseRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     RoleId arg = (RoleId)argument;
/* 22 */     RoleBaseRes res = (RoleBaseRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/* 28 */         this.base = res.value;
/*    */       else
/* 30 */         this.base = null;
/* 31 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 37 */     synchronized (this)
/*    */     {
/* 39 */       this.retcode = 4;
/* 40 */       this.base = null;
/* 41 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleBase
 * JD-Core Version:    0.6.2
 */